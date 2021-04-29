<template>
<div class="flex justify-center">
    <form id="form-component" @submit.prevent="submit" class="w-full max-w-5xl">
        <h2 class="my-8">
        Please fill out the Skill Shop application for system:<span></span>
        </h2>
        <div class="flex items-center border-b border-blue-600 py-2 my-6">
            <input 
            v-model="sysid" 
            id="sysid" 
            class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none" type="text" 
            placeholder="System Id" 
            aria-label="System Id" 
            
            >
        </div>
        <div v-if="errors.sysid" class="text-red-400 p-2">{{ errors.sysid[0] }}</div>
        <div class="flex items-center border-b border-blue-600 py-2 my-6">
            <input 
            v-model="form.productName" 
            id="product-name" 
            class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none" 
            type="text" 
            placeholder="Product Name" 
            aria-label="Product Name"
            >
        </div>
        <div v-if="errors.productName" class="text-red-400 p-2">{{ errors.productName[0] }}</div>
        <div class="flex items-center border-b border-blue-600 py-2 my-6">
            <textarea 
            v-model="form.overview"
            id="overview" 
            cols="30" 
            rows="10" 
            class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none" 
            type="text" 
            placeholder="Overview" 
            aria-label="Overview"
            >
            </textarea>
        </div>
        <div v-if="errors.overview" class="text-red-400 p-2">{{ errors.overview[0] }}</div>

        <!-- <CoursesComponent :sysid="sysid" :apikey="apikey"></CoursesComponent> -->
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

        <div class="bg-white rounded-md shadow overflow-x-auto">
            <table class="w-full whitespace-nowrap">
                <tr class="text-left font-bold">
                <th class="px-6 pt-6 pb-4">Add / Remove</th>
                <th class="px-6 pt-6 pb-4">Course ID</th>
                <th class="px-6 pt-6 pb-4">Course Name</th>
                <th class="px-6 pt-6 pb-4" colspan="2">Category</th>
                </tr>
                
                <tr v-for="course in courses" :key="course.id" class="hover:bg-gray-100 focus-within:bg-gray-100">
                <td class="border-t">
                    <button 
                        ref="addBtn"
                        v-on:click="handleSelectedCourse($event, course)" 
                        v-bind:id="course.courseId"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                        type="button">
                        Add
                    </button>
                </td>
                <td class="border-t">
                    <span class="px-6 py-4 flex items-center">
                    {{ course.courseId }}
                    </span>  
                </td>
                <td class="border-t">
                    <span class="px-6 py-4 flex items-center">
                    {{ course.courseName }}
                    </span>
                </td>
                <td class="border-t  w-px">
                    <span class="px-6 py-4 flex items-center">
                    {{ course.categoryName }}
                    </span>
                </td>

                </tr>
             
                <tr v-if="courses.length === 0">
                <td class="border-t px-6 py-4" colspan="4">No courses found.</td>
                </tr>
            </table>
        </div>
        <div>
            <button 
            class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray transition ease-in-out duration-150"
            @click="getCourses(), getCoursesCount()"
            type="button">  
                Get Courses
            </button>
        </div>
        
        <div class="container selected-courses flex flex-col my-10"></div>
        <!-- PRICE POINTS -->
        <div class="spacer m-24"></div>

        <div id="price-point-container" class="priceContainer flex flex-col">
            <div id="price-point-wrapper1" class="container price-wrap flex items-center my-10">
                <div class="w-1/4 md:w-1/2 mb-6 md:mb-0">
                    <label class="price-label block mb-2">Price Point 1</label>
                    <input 
                    
                    id="price1" 
                    class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white" 
                    type="number" 
                    placeholder="$ Price" 
                    aria-label="Price"
                    >
                </div>
                <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                    <label class="block mb-2" for="pricing-term">
                        Term
                    </label>
                    <div class="relative">
                        <select 
                        
                        id="term1"
                        class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" 
                        >
                        <option 
                        v-for="term in terms" 
                        :key="term.id"
                        v-bind:value="term"
                        >{{term.toUpperCase()}}</option>

                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                        </div>
                    </div>
                </div>
                
                <div class="w-full md:w-1/3 pr-3 mb-6 md:mb-0">
                    <label class="block mb-2" for="pricing-model">
                        Pricing Model
                    </label>
                    <div class="relative">
                        <select 
                        
                        id="priceModel1"
                        class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" 
                        >
                        <option 
                        v-for="pricingModel in pricingModels" 
                        :key="pricingModel.id">
                        {{pricingModel.toUpperCase()}}
                        </option>
                        

                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="price-btn-container">
            <a 
            v-on:click="makePricePoint()"
            id="price-btn" 
            class="price-point bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow cursor-pointer" >
                Add New Price Option
            </a>
        </div>
        <div v-if="errors.pricePoints" class="text-red-400 p-2">{{ errors.pricePoints[0] }}</div>
        <div class="spacer m-24"></div>
        <div class="flex items-center border-b border-blue-600 py-2 my-6">
            <input 
            v-model="form.sme"
            id="sme-input" 
            class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none" type="text" 
            placeholder="Subject Matter Expert" 
            aria-label="Subject Matter Expert"
            >
        </div>
        <div v-if="errors.sme" class="text-red-400 p-2">{{ errors.sme[0] }}</div>
        <div class="flex items-center border-b border-blue-600 py-2 my-6">
            <textarea
            v-model="form.bio" 
            id="sme-bio" 
            cols="30" 
            rows="10" 
            class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none" type="text" 
            placeholder="Bio" 
            aria-label="Bio"></textarea>
        </div>
        <div v-if="errors.bio" class="text-red-400 p-2">{{ errors.bio[0] }}</div>
        <div class="flex items-center border-b border-blue-600 py-2 my-6">
            <input
            v-model="form.imgLink" 
            id="sme-image" 
            class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none" type="text" 
            placeholder="Image Link" 
            aria-label="Image Link"
            >
        </div>
        <div v-if="errors.imgLink" class="text-red-400 p-2">{{ errors.imgLink[0] }}</div>
        <div class="sub-btn-container my-10">
            <a 
            v-on:click="submit();"
            id="sub-btn" 
            class="submit bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow cursor-pointer" 
            type="submit">
                Submit
            </a>
        </div>
    </form>
</div>
</template>

<script>
    import CoursesComponent from '@/Shared/CoursesComponent';
    import CryptoJS from 'crypto-js';
    const key = 'mooapznTlQ7Ut84z5DMaR3WxwRzxuRX7iptx8EXf0fY=';
    const iv = 'toPet898818'

    export default {
        
        mounted(){
            this.sysid = this.aesDencrypt(this.encSysid);
            this.apikey = this.aesDencrypt(this.encApikey);           
        },
        props:[
            'errors',
            'flash',
            'encSysid',
            'encApikey',
            
            
        ],
        components:{
            CoursesComponent,

        },
        data(){
            return{
                sysid: '',
                apikey: '',
                courses: '',
                selectedCourses: [],
                pagesCount: null,
                paginationCount: 14,
                courseAdded: false,
                itemsPerPage: 30,
                pageNum: 1,
                priceIndex: 1,
                terms: [
                    '',
                    'monthly',
                    'quarterly',
                    'yearly',
                    'one time',
                ],   
                pricingModels: [
                    '',
                    'b2c',
                    'b2b'
                ],
                form: this.$inertia.form({
                    sysid: this.sysid,
                    productName: '',
                    overview: '',
                    selectedCourses: [],
                    pricePoints: {},
                    sme: '',
                    bio: '',
                    imgLink: '',
                    
                }),
                
            }
        },
        methods: {
            aesDencrypt(txt) {
                const cipher = CryptoJS.AES.decrypt(txt, CryptoJS.enc.Utf8.parse(key), {
                iv: CryptoJS.enc.Utf8.parse(iv),
                mode: CryptoJS.mode.CBC
            })

            return CryptoJS.enc.Utf8.stringify(cipher).toString()
            },
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
            },
            makeSelectPointer: function(){
                let div = document.createElement('div');
                div.classList.add('pointer-events-none',
                'absolute','inset-y-0','right-0','flex','items-center','px-2','text-gray-700');
                let svg = document.createElement('svg');
                svg.classList.add('fill-current','h-4','w-4');
                svg.setAttribute('xmlns', 'http://www.w3.org/2000/svg');
                svg.setAttribute('viewBox', '0 0 20 20');
                let path = document.createElement('path');
                path.setAttribute('d','M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z');
                svg.appendChild(path);
                div.appendChild(svg);
                return div;
            },
            //function makes a new price point container
            makePricePoint: function(){
                
                let pricePointContainer = document.querySelector('#price-point-container');
                let pricePointCount = document.querySelectorAll('.price-wrap').length+1;
                //new price point wrapper
                let newPricePointWrapper = document.createElement('div');
                newPricePointWrapper.setAttribute('id', 'price-point-wrapper' + pricePointCount)
                newPricePointWrapper.classList.add(
                    'container',
                    'price-wrap',
                    'flex',
                    'items-center',
                    'my-10'
                );
                
                //new price point
                    let newPricePoint = document.createElement('div');
                    newPricePoint.classList.add('w-1/4', 'md:w-1/2', 'mb-6', 'md:mb-0');
                    let pricePointLabel = document.createElement('label');
                    pricePointLabel.classList.add('price-label', 'block', 'mb-2');
                    pricePointLabel.textContent = "Price Point " + pricePointCount;
                    let pricePointInput = document.createElement('input');
                    pricePointInput.setAttribute('id', 'price' + pricePointCount);
                    pricePointInput.setAttribute('type', 'number');
                    pricePointInput.setAttribute('placeholder', '$ Price');
                    pricePointInput.setAttribute('aria-label', 'Price' + pricePointCount);
                    pricePointInput.classList.add(
                        'appearance-none',
                        'block',
                        'w-full',
                        'bg-gray-200',
                        'text-gray-700',
                        'border','rounded',
                        'py-3','px-4',
                        'leading-tight',
                        'focus:outline-none',
                        'focus:bg-white'
                    )
                    
                    newPricePoint.appendChild(pricePointLabel);
                    newPricePoint.appendChild(pricePointInput);
                    newPricePointWrapper.appendChild(newPricePoint);
                    
                //new term
                    let selectPointer = this.makeSelectPointer();
                    
                    let termDiv = document.createElement('div');
                    termDiv.classList.add('w-full','md:w-1/3','px-3','mb-6','md:mb-0');
                    let relDiv = document.createElement('div');
                    relDiv.className = "relative";
                    let termLabel = document.createElement('label');
                    termLabel.classList.add('block','mb-2');
                    termLabel.setAttribute('for', 'pricing-term' + pricePointCount);
                    termLabel.textContent = "Term";
                    //select
                    let select = document.createElement('select');
                    select.id = "term" + pricePointCount;
                    select.classList.add(
                    'block',
                    'appearance-none', 
                    'w-full',
                    'bg-gray-200',
                    'border','border-gray-200',
                    'text-gray-700', 
                    'py-3', 'px-4', 'pr-8',
                    'rounded',
                    'leading-tight', 
                    'focus:outline-none', 
                    'focus:bg-white',
                    'focus:border-gray-500');
                    this.terms.forEach( term => {
                        let option = document.createElement('option');
                        option.text = term.toUpperCase();
                        option.value = term;
                        select.appendChild(option);
                    });
                    
                    relDiv.appendChild(select);
                    relDiv.appendChild(this.makeSelectPointer());
                    
                    termDiv.appendChild(termLabel);
                    termDiv.appendChild(relDiv);
                    newPricePointWrapper.appendChild(termDiv);
                    
                //new pricing model
                    let pmDiv = document.createElement('div');
                    pmDiv.classList.add('w-full','md:w-1/3','px-3','mb-6','md:mb-0');
                    let pmRelDiv = document.createElement('div');
                    pmRelDiv.className = "relative";
                    let pmTermLabel = document.createElement('label');
                    pmTermLabel.classList.add('block','mb-2');
                    pmTermLabel.setAttribute('for', 'pricing-model' + pricePointCount);
                    pmTermLabel.textContent = "Pricing Model";
                    //select
                    let pmSelect = document.createElement('Select');
                    pmSelect.id = "priceModel" + pricePointCount;
                    pmSelect.classList.add(
                    'block',
                    'appearance-none', 
                    'w-full',
                    'bg-gray-200',
                    'border','border-gray-200',
                    'text-gray-700', 
                    'py-3', 'px-4', 'pr-8',
                    'rounded',
                    'leading-tight', 
                    'focus:outline-none', 
                    'focus:bg-white',
                    'focus:border-gray-500');
                    this.pricingModels.forEach( term => {
                        let option = document.createElement('option');
                        option.text = term.toUpperCase();
                        option.value = term;
                        pmSelect.appendChild(option);
                    });
                    pmRelDiv.appendChild(pmSelect);
                    pmRelDiv.appendChild(selectPointer);
                    pmDiv.appendChild(pmTermLabel);
                    pmDiv.appendChild(pmRelDiv);
                    newPricePointWrapper.appendChild(pmDiv);
                pricePointContainer.appendChild(newPricePointWrapper);
                //adds new object to form.pricePoint
                let addedPrices = document.querySelectorAll('.price-wrap');
                addedPrices.forEach((pricePoint) => {
                    
                    this.form.pricePoints[`pricePoint${addedPrices.length}`] = {
                    price: '',
                    term: '',
                    pricingModel: ''
                };
                
                });
                
                
            },
            submit() {
                //if first price point has values, add those values to pricePoints object
                if( document.querySelector(`#price1`).value != '' &&
                    document.querySelector(`#term1`).value != '' &&
                    document.querySelector(`#priceModel1`).value != ''
                    ){
                        let newObj = {
                                price: document.querySelector(`#price${this.priceIndex}`).value,
                                term: document.querySelector(`#term${this.priceIndex}`).value,
                                priceModel: document.querySelector(`#priceModel${this.priceIndex}`).value
                            };
        
                            this.form.pricePoints[`pricePoint${this.priceIndex}`] = newObj;
                    }
                Object.entries(this.form.pricePoints).forEach(([key, value]) => {
                    //loop through form.pricePoints and assign values dynamically
                    let newObj = {
                        price: value.price ? document.querySelector(`#price${this.priceIndex}`).value : '',
                        term: value.term ? document.querySelector(`#term${this.priceIndex}`).value : '',
                        priceModel: value.priceModel ? document.querySelector(`#priceModel${this.priceIndex}`).value : ''
                    };
                    this.form.pricePoints[`${key}`] = newObj;
                    this.priceIndex++;
                    });
                //console.log(this.form.pricePoints)
                this.$inertia.post('/skillshop/form/submit', this.form)
            },
        },

    }
</script>