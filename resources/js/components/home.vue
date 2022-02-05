<template>
    <div>
      <div  class="z-0 w-10/12 mx-auto  grid grd-cols-1   sm:grid-cols-2 pt-6 md:grid-cols-3 text-center   gap-10  ">
            
                <div  class="transform bg-gray-300 shadow-lg  hover:bg-gray-800 
                            text-gray-800 hover:scale-110 hover:text-sm 
                            transition duration-300 hover:text-white
                            rounded-md shadow-lg"
                    style="direction:ltr">
                   
                    <div class=" text-center w-full  p-6 ">
                        <div class="border-solid border-b-2 border-gray-800 hover:border-white pb-2">
                             <p class="inline">بەكارهێنەر</p>  <img src="icon/10_avatar-512.png" class="w-12 inline" alt="">
                        </div>
                       <p class="bg-gray-800 hover:bg-white rounded-full text-white hover:text-gray-800  py-2 px-3 text-sm mt-3">
                           {{users}}
                        </p>
                    </div>
                    
                </div>
            
                <div  class="transform bg-gray-300 shadow-lg  hover:bg-gray-800 
                            text-gray-800 hover:scale-110 hover:text-sm 
                            transition duration-300 hover:text-white
                            rounded-md shadow-lg"
                    style="direction:ltr">
                   
                    <div class=" text-center w-full  p-6 ">
                        <div class="border-solid border-b-2 border-gray-800 hover:border-white pb-2">
                             <p class="inline">خواردنەكان</p>  <img src="icon/food.png" class="w-12 inline" alt="">
                        </div>
                       <p class="bg-gray-800 hover:bg-white rounded-full text-white hover:text-gray-800  py-2 px-3 text-sm mt-3">
                           {{foods}}
                        </p>
                    </div>
                    
                </div>
                <div  class="transform bg-gray-300 shadow-lg  hover:bg-gray-800 
                            text-gray-800 hover:scale-110 hover:text-sm 
                            transition duration-300 hover:text-white
                            rounded-md shadow-lg"
                    style="direction:ltr">
                   
                    <div class=" text-center w-full  p-6 ">
                        <div class="border-solid border-b-2 border-gray-800 hover:border-white pb-2">
                             <p class="inline">كۆی خواردنی فرۆشراو</p>  <img src="icon/mainorder.png" class="w-12 inline" alt="">
                        </div>
                       <p class="bg-gray-800 hover:bg-white rounded-full text-white hover:text-gray-800  py-2 px-3 text-sm mt-3">
                           {{ordered}}
                        </p>
                    </div>
                    
                </div>




            </div>
    </div>
</template>

<script>
export default {
    data(){
        return{
            users:'',
            foods:'',
            ordered:''
        }
    },
    methods:{
        loadCountData(){
            axios.get('/api/countData').then(({data})=>{
               this.users=data.users;
               this.foods=data.foods;
               this.ordered=data.orders;
            })  
        }
    },
    created(){
        this.loadCountData();
    }
}
</script>