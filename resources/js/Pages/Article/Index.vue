<template>
    <div class="grid grid-cols-2 gap-4 p-48 mt-16">
    
        <div class="ml-8 w-96 shadow p-16 rounded text-center bg-white place-self-end">
            <i class="fas fa-network-wired"></i>
            <span class="text-3xl">webservices</span> 
        </div>


        <div class="ml-8 w-96 shadow p-16 rounded text-center bg-white place-self-start">
            <i class="fas fa-network-wired"></i>
            <span class="text-3xl">Configuration</span> 
        </div>
    </div>
</template>
<script>
    import AppLayout from '@/Layouts/AppLayout'


    export default {
        components:{
            AppLayout,

        },
        layout: AppLayout,
    }
</script>
