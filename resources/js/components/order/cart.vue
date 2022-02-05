<template>
    <div>
        <p class="text-center">
           كۆی گشتی : {{total|toCurrency}}
        </p>

        <form action="" @submit.prevent="saveData">
            <button type="submit" :class="submitted==false?'bg-gray-800 rounded-md p-2 px-4 text-gray-300 mb-2':'bg-gray-300 rounded-md p-2 px-4 text-gray-800 mb-2 cursor-not-allowed'" :disabled="submitted">
              {{submitted==true?"چاوەڕێبە ...":"پاراستن"}}
            </button>
        </form>
         <div class="w-full p-4 pt-12 gap-10 gap-y-20 grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5
                    border-solid border-t-2 border-gray-800">
            
             <div class="bg-white p-2 h-50 rounded-t-full 
                        flex transform transition
                        duration-300 hover:scale-90
                        justify-center shadow-lg items-center relative"
                v-for="(item,index) in foods" :key="index">
                 <img src="icon/order.png"  class="w-20 absolute top-0" 
                    style="position:absolute;top:-40px" alt="">
                    <div class=" w-full absolute bottom-0">
                        <div class="text-center ">
                            <p  style="font-size:14px"> ناو : {{item.name}}</p>
                            <p  style="font-size:14px"> نرخ : {{item.price|toCurrency}}</p>
                            <p  style="font-size:14px"> ژمارەی داواكراو : {{item.number_of_sale}}</p>
                            <p  style="font-size:14px"> كۆی گشتی : {{item.number_of_sale * item.price|toCurrency}}</p>
                           
                        </div>
                        <div class="mt-2">
                                <button class="w-full py-1 text-sm border-solid border-2
                                                rounded-lg bg-gray-800 text-gray-300 
                                                " @click="loadSingleFood(item.id)">
                                    <img src="icon/edit.svg" class="w-6 inline" alt=""> گۆڕین
                                </button>
                        </div>
                    </div>
                 
             </div>
         </div>

         
     <vue-tailwind-modal
      :showing="updateModal"
      @close="updateModal = false"
      :showClose="true"
      class="z-50 bg-gray-800 bg-opacity-25"
    >
    
      <form class="text-center mb-10" @submit.prevent="updateNumber(formUpdate.id)">
      
        <div class="border-b border-blue-900 py-2 w-4/6 mx-auto mt-3">
            <p class="text-center mb-10">{{formUpdate.name}}</p>
          <input
            v-model="formUpdate.number_of_sale"
            class="appearance-none bg-transparent w-full text-center border-none text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none"
            type="number"
            placeholder="ژمارەی داواكراو"
            :class="{ 'is-invalid': formUpdate.errors.has('number_of_sale') }"
          />
          <has-error
            :form="formUpdate"
            field="price"
            class="text-red-400"
          ></has-error>
        </div>
        <div class="py-2 w-4/6 mx-auto mt-3">
          <button
            class="bg-gray-800 text-gray-300 p-2 rounded-lg w-full shadow text-sm px-4 focus:outline-none"
          >
            تازەی بكەرەوە
          </button>
          <br>

        </div>
       
      </form>
    </vue-tailwind-modal>

    </div>
</template>

<script>
export default {
    data(){
        return{
          submitted: false,
            foods:[],
            total:0,
            updateModal: false,
             formUpdate:new Form({
                    id:'',
                    name:'',
                    price:'',
                    number_of_sale:'',
                  })
        }
    },
    methods:{
         loadFood(){
          axios.get('api/indexOrder').then(({data})=>{
                this.foods=data.foods;
                this.total=data.total;
                }
             )
          },

        loadSingleFood(id){
            this.formUpdate.reset();
                axios.get("api/singleOrder/"+id+"").then(({ data }) => {
                this.formUpdate.fill(data.food[0]);
                this.updateModal=true;
            });
        },
         updateNumber(id){
            this.formUpdate.put('api/singleOrderUpdate/'+id+'').then(()=>{
            Load.$emit('newOrder');
            this.updateModal=false;
            })
        },
         saveData(){
           if(this.foods.length>0){

             this.submitted=true;
              this.$swal({
               title: "دڵنیای لە پاراستنی",
               text: "لەكاتی نەبوونی داواكاری گۆڕین بەڵێ هەڵبژێرە",
               type: "warning",
               showCancelButton: true,
               confirmButtonText: "بەڵێ",
               cancelButtonText: "نەخێر",
               showCloseButton: true,
               showLoaderOnConfirm: true,
             }).then((result) => {
               if (result.value) {
                 this.$swal("", "بەسەركەوتووی پارێزرا", "success");
                 
                     axios.post('api/orderFood').then(()=>{
                     this.$router.push('/order');
                 })
               } else {
                  this.submitted=false;
                 this.$swal("پەشمان بویتەوە", "", "info");
               }
             });
           }else{
              this.$router.push('/order');
           }
          },
          
    

    },
      created(){
         Load.$on('newOrder',()=>{
             this.loadFood();
         })
          this.loadFood();
      }
}
</script>