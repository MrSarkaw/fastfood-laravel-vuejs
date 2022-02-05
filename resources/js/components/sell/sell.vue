<template>
    <div>
       <table class="table-auto bg-gray-800 rounded-lg w-full shadow-xl text-center w-12/12 md:w-8/12 mx-auto">
        <thead class="text-gray-300 rounded-lg">
            <tr>
            <th class="px-4 py-2">ژ</th>
            <th class="px-4 py-2">ناو</th>
            <th class="px-4 py-2">نرخ</th>
            <th class="px-4 py-2">چالاكی</th>
            </tr>
        </thead>
        <tbody class="bg-gray-300 text-gray-800">
            <tr v-for="(item,index) in sells" :key="index" class="border-solid border-b-2 border-gray-800"> 
            <td class="border px-4 py-2">{{item.id}}</td>
            <td class="border px-4 py-2">{{item.name}}</td>
            <td class="border px-4 py-2">{{item.price|toCurrency}}</td>
            <td class="border px-4 py-2">
                <button class="bg-red-500 p-1 px-2 text-sm text-gray-300  rounded" @click="deleteRow(item.id,index)">گەڕاندنەوە</button>
            </td>
            </tr>
            <tr>
                <td colspan="4">
                   <infinite-loading @infinite="load" ref="infiniteLoading">
                        <div slot="no-more"></div>
                        <div slot="no-results"></div>
                    </infinite-loading>
                </td>
            </tr>
            
        </tbody>
        </table>
    </div>
</template>

<script>
export default {
    data(){
        return{
            sells:[],
            page:1,
        }
    },
    methods:{
        load($state){
            axios.get('/api/orderFood',{
                params:{
                    page:this.page
                }
            }).then(({data})=>{
                let loaddata=data.food.data;
                if(loaddata.length){
                    this.page+=1;
                    this.sells=this.sells.concat(loaddata);
                   $state.loaded();
                    } else {
                        $state.complete();
                    }
            }).catch(error=>{
                console.log(error)
            })
        },

        deleteRow(id,index){
            this.$swal({
               title: "دڵنیای لە گەڕاندنەوەی ؟ ",
               text: "لەكاتی پەشیمان بوونەوە لە خواردنی داواكراو ئەم كردارە بەكاریەت",
               type: "warning",
               showCancelButton: true,
               confirmButtonText: "بەڵێ",
               cancelButtonText: "نەخێر",
               showCloseButton: true,
               showLoaderOnConfirm: true,
             }).then((result) => {
               if (result.value) {
                 this.$swal("", "بەسەركەوتووی گەڕێندرایەوە", "success");
                     axios.delete('api/orderFood/'+id+'').then(()=>{
                         this.sells.splice(index,1);
                 })
               } else {
                 this.$swal("پەشمان بویتەوە", "", "info");
               }
             });
        }
    },
    created(){
        this.load();
    }
}
</script>