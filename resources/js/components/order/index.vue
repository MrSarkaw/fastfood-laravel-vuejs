<template>
    <div>
           <router-link to="/cartorder" class="transform hover:scale-90 transition duration-300 bg-gray-800 text-gray-300 p-2 rounded-lg shadow text-sm px-4 focus:outline-none">
               <img src="icon/cart.svg" class="w-6 inline" alt="">
                خواردنی كڕدراو
           </router-link>
          
         <div class="w-full p-4 pt-12 mt-6 gap-10 gap-y-20 grid grid-cols-2 md:grid-cols-2 lg:grid-cols-7
                    border-solid border-t-2 border-gray-800">
            
             <div class="bg-white p-2 h-40 rounded-t-full 
                        flex transform transition
                        duration-300 hover:scale-90
                        justify-center shadow-lg items-center relative"
                v-for="(item,index) in foods" :key="index">
                 <img src="icon/order.png"  class="w-20 absolute top-0" 
                    style="position:absolute;top:-40px" alt="">
                    <div class="mt-10 w-full absolute bottom-0">
                        <div class="text-center ">
                            <p  style="font-size:14px">{{item.name}}</p>
                            <p  style="font-size:12px">{{item.price|toCurrency}}</p>
                        </div>
                        <div class="mt-2">
                            <form @submit.prevent="order(item.id,$event)" >
                                <input type="number" class="w-full pb-1 focus:outline-none text-center text-sm
                                                        
                                                        text-gray-800" id="" placeholder="ژمارەی داواكراو"
                                                        @keyup="setnumber"
                                                        style="font-size:12px">
                                <button class="w-full py-1 text-sm border-solid border-2
                                                rounded-lg bg-gray-800 text-gray-300
                                                ">
                                    <img src="icon/add.svg" class="w-6 inline" alt=""> داواكردن
                                </button>
                            </form>
                           
                        </div>
                    </div>
                 
             </div>

            
            
            
         </div>

    </div>
</template>

<script>
export default {
    data(){
        return{
            number:0,
            foods:[]
        }
    },
      methods:{
      loadFood(){
          axios.get('api/foods').then(({data})=>{
                this.foods=data.foods;
                }
             )
          },
          setnumber(e){
              this.number=e.target.value
          },
          order(index,event){
              if(this.number!=''){
                  axios.put('/api/order/'+index+'',{
                      "number_of_sale":this.number
                  }).then(()=>{
                    this.number=0;
                    event.target.reset(); 
                  })
              }
              
          },
           

      },
      created(){
         
          this.loadFood();
      }
}
</script>