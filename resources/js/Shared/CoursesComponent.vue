<template>
    
    <div> 
        <!-- selected courses -->
        <div v-if="selectedCourses.length > 0">
            <div class="p-4 flex flex-column flex-wrap justify-center border-solid border-2 border-gray-600">
                <span 
                v-for="(course, index) in selectedCourses" 
                :key="course" 
                v-on:click="removeSelectedCourse($event, course, index)"
                class="bg-gray-400 px-2 py-0 m-2 rounded cursor-pointer">X <span class="ml-2">{{course}}</span>
                </span>
            </div>
        </div>
        <!--End selected courses -->
        <br>
        <label for="" class="block mb-2">Courses</label>
        <div class="container courses-container flex flex-col my-10 py-10 px-4 border-solid border-2 border-gray-600">
            <table class="border-separate table-auto">
                <thead class="mb-5">
                <tr class="text-left">
                    <th>
                        Creds: {{ sysid }} : {{ apikey }}
                    </th>
                    <th class="pl-6 pb-10">
                        Course Name
                    </th>
                    <th class="pb-10">
                        Course Id
                    </th>
                </tr>
                <tr>
                    <th>
                    </th>
                    <th>
                    </th>
                    <th>
                    </th>
                </tr>
                </thead>
                <tbody>
                <tr 
                v-for="(course, index) in courses" 
                :key="index" 
                class="text-left">
                    <td>
                        <button 
                            ref="addBtn"
                            v-on:click="handleSelectedCourse($event, course)" 
                            v-bind:id="course.courseId"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                            type="button">
                            Add
                        </button>
                    </td>
                    <td class="pl-6">
                        {{ course.courseName }} 
                    </td>
                    <td>
                        {{ course.courseId }}
                    </td>
                </tr>
                </tbody>
            </table>
            <!-- <div v-if="errors.selectedCourses" class="text-red-400 p-2">{{ errors.selectedCourses[0] }}</div> -->
            
        </div>
        <div v-if="courses">
            <!-- <pagination-component :courses="courses" :coursesCount="coursesCount" :paginationCount="paginationCount" ></pagination-component> -->

            <t-pagination
                :totalItems="coursesCount"
                :perPage="30"
                :limit="10"
                @on:change="updatePage($event)"
            />
        </div>
        <button 
            class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray transition ease-in-out duration-150"
            @click="getCourses(), getCoursesCount()"
            type="button">  
                Get Courses
            </button>
    </div>
</template>

<script>
import JetButton from '@/Jetstream/Button'
import PaginationComponent from './PaginationComponent'


export default {
    props: [
        'sysid',
        'apikey',
        'page',
        
    ],
    components:{
        JetButton,
        PaginationComponent,
    },
    data(){
        return {
            courses: '',
            coursesCount: '',
            paginationCount: '',
            selectedCourses: [],
            itemsPerPage: 30,

        }
    },
    methods: {
        getCourses: function(pageNum){
            axios.get('https://webservices.lightspeedvt.net/REST/V1/courses',{
                params: {
                    systemId: this.sysid,
                    itemsPerPage: this.itemsPerPage,
                    
                },
                headers: {
                    'Authorization': 'Basic '+ btoa(`${this.apikey}:lsvt`)
                }
            })
            .then( response => {
                // handle success
            
                this.courses = response.data;
                console.log(response)
                
            })
            .catch(error => {
                // handle error
                console.log(error);
            })
        },
        getCoursesCount: function(){
            axios.get('https://webservices.lightspeedvt.net/REST/V1/courses/count',{
                params: {
                    systemId: this.sysid,
                },
                headers: {
                    'Authorization': 'Basic '+ btoa(`${this.apikey}:lsvt`)
                }
            })
            .then( response => {
                // handle success
                this.coursesCount = response.data;
                this.paginationCount = Math.ceil(response.data / this.itemsPerPage);
                
            })
            .catch(error => {
                // handle error
                console.log(error);
            })
        },
        updatePage: function(pageClicked){
            //getting the page that the user clicked from the t-pagination component
            console.log(pageClicked);
        },
        handleSelectedCourse: function(event, course){
                
            //check to see if course has been added
            if(!this.selectedCourses.includes(event.target.id)){
                //if course has not been added, add to selectedCourses array
                this.selectedCourses.push(event.target.id);
                //change button text and bg to green
                this.checkBtnState();
            // if removed button clicked, remove from selected courses and change button back to original state
            }else if(this.selectedCourses.includes(event.target.id)){
                let btnIndex = this.selectedCourses.indexOf(event.target.id);
                this.selectedCourses.splice(btnIndex, 1);
                
                this.checkBtnState();
            }
                
        },
        checkBtnState: function (){
            if(this.$refs.addBtn){
                this.$refs.addBtn.forEach(btn =>{
                    if(this.selectedCourses.includes(btn.id)){
                        btn.textContent = "Remove";
                        btn.classList.remove('bg-blue-500')
                        btn.classList.add('bg-red-500');    
                        return            
                    }
                
                
                    if(!this.selectedCourses.includes(btn.id)){
                        btn.textContent = "Add";
                        btn.classList.remove('bg-red-500')
                        btn.classList.add('bg-blue-500');
                        return
                    }
                }); 
            }
        },
        removeSelectedCourse: function(event, course ,index){
            this.selectedCourses.splice(index, 1);
            //changes button text and background color
            this.$refs.addBtn.forEach(btn => {
                if(btn.id == course){
                    btn.innerText = "Add";
                    btn.classList.remove('bg-green-400');
                    btn.classList.add('bg-blue-500');
                    
                }
            })
        },
        updated: function(){
            this.checkBtnState();
            if(this.errors.productName){
               console.log(this.errors)
           }
        }
    }
}
</script>