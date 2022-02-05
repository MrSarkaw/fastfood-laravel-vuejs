<template>
    <div>
         <form class="text-center mb-10" @submit.prevent="updateUser(formUpdate.id)">
        <div class="border-b border-blue-900 py-2 w-6/6 sm:w-4/6 lg:w-3/6 mx-auto">
          <input
            v-model="formUpdate.name"
            class="appearance-none bg-transparent w-full text-center border-none text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none"
            type="text"
            placeholder="ناوی بەكارهێنەر"
            :class="{ 'is-invalid': formUpdate.errors.has('name') }"
          />
          <has-error :form="formUpdate" field="name" class="text-red-400"></has-error>
        </div>
        <div class="border-b border-blue-900 py-2 w-6/6 sm:w-4/6 lg:w-3/6 mx-auto mt-3">
          <input
            v-model="formUpdate.email"
            class="appearance-none bg-transparent w-full text-center border-none text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none"
            type="text"
            placeholder="ئیمەیل"
            :class="{ 'is-invalid': formUpdate.errors.has('email') }"
          />
          <has-error
            :form="formUpdate"
            field="email"
            class="text-red-400"
          ></has-error>
        </div>
        <div class="border-b border-blue-900 py-2 w-6/6 sm:w-4/6 lg:w-3/6 mx-auto mt-3">
          <input
            v-model="formUpdate.password"
            class="appearance-none bg-transparent w-full text-center border-none text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none"
            type="password"
            placeholder="تێپەڕوشە"
            :class="{ 'is-invalid': formUpdate.errors.has('password') }"
          />
          <has-error
            :form="formUpdate"
            field="password"
            class="text-red-400"
          ></has-error>
        </div>
        <div class="py-2 w-6/6 sm:w-4/6 lg:w-3/6 mx-auto mt-3">
          <button
            class="bg-gray-800 text-gray-300 p-2 rounded-lg w-full shadow text-sm px-4 focus:outline-none"
          >
            تازەی بكەرەوە
          </button>
        </div>
      </form>
    </div>
</template>
<script>
export default {
    data(){
        return{
            formUpdate:new Form({
                id:'',
                name:'',
                email:'',
                password:'',
            })
        }
    },
    methods:{
         loadCurrentUser(){
         axios.get("api/currentUser/").then(({ data }) => {
           this.formUpdate.fill(data.user);
      });
     },
      updateUser(id){
     this.formUpdate.put('api/users/'+id+'').then(()=>{
        this.$swal("", "بەسەركەوتووی تازەكرایەوە", "success");
     })
    }
    },
    created() {
    this.loadCurrentUser();
  },
}
</script>