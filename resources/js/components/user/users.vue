<template>
  <div>
    <insert-user
      class="mt-1 z-50 border-b-2 border-gray-800 pb-4"
    ></insert-user>
    <div
      class="z-0 w-full grid grd-cols-1 sm:grid-cols-2 pt-6 lg:grid-cols-4 md:grid-cols-3 text-center gap-10"
    >
      <div
        class="transform bg-white hover:bg-gray-800 border-solid border-2 border-gray-800 text-gray-800 hover:scale-90 hover:text-sm transition duration-300 hover:text-white rounded-md shadow-lg"
        v-for="(item, index) in users"
        :key="index"
        style="direction: ltr"
      >
        <div class="text-right bg-gray-800 p-2" style="direction: rtl">
          <button
            class="bg-red-400 p-2 rounded focus:outline-none"
            @click="deleteUser(item.id, index)"
          >
            <img src="icon/delete.svg" class="w-3" alt="" />
          </button>
          <button class="bg-blue-400 p-2 rounded focus:outline-none" @click="loadSingleUser(item.id)">
            <img src="icon/edit.svg" class="w-3" alt="" />
          </button>
          <button class="bg-green-600 p-2 rounded focus:outline-none">
            <img src="icon/levels.svg" class="w-3" alt="" />
          </button>
        </div>
        <div class="md:flex w-full p-2">
          <div class="md:w-3/12">
            <img src="icon/10_avatar-512.png" class="w-12 mx-auto" alt="" />
          </div>
          <div class="md:w-9/12">
            <p class="mt-1">{{ item.name }}</p>
            <p>{{ item.email }}</p>
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
    
      <form class="text-center mb-10" @submit.prevent="updateUser(formUpdate.id)">
        <div class="border-b border-blue-900 py-2 w-4/6 mx-auto">
          <input
            v-model="formUpdate.name"
            class="appearance-none bg-transparent w-full text-center border-none text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none"
            type="text"
            placeholder="ناوی بەكارهێنەر"
            :class="{ 'is-invalid': formUpdate.errors.has('name') }"
          />
          <has-error :form="formUpdate" field="name" class="text-red-400"></has-error>
        </div>
        <div class="border-b border-blue-900 py-2 w-4/6 mx-auto mt-3">
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
        <div class="border-b border-blue-900 py-2 w-4/6 mx-auto mt-3">
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
        <div class="py-2 w-4/6 mx-auto mt-3">
          <button
            class="bg-gray-800 text-gray-300 p-2 rounded-lg w-full shadow text-sm px-4 focus:outline-none"
          >
            تازەی بكەرەوە
          </button>
        </div>
      </form>
    </vue-tailwind-modal>
  </div>
</template>
<script>
import insertUser from "./insert.vue";
export default {
  data() {
    return {
      users: [],
      updateModal: false,
      formUpdate:new Form({
        id:'',
        name:'',
        email:'',
        password:'',
      })
    };
  },
  components: {
    insertUser,
  },
  methods: {
    loadUser() {
      axios.get("api/users").then(({ data }) => {
        this.users = data.users;
      });
  },
    deleteUser(data, index) {
      this.$swal({
        title: "دڵنیای لە سڕینەوەی",
        text: "",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "بەڵێ",
        cancelButtonText: "نەخێر",
        showCloseButton: true,
        showLoaderOnConfirm: true,
      }).then((result) => {
        if (result.value) {
          this.$swal("", "بەسەركەوتووی سڕایەوە", "success");
          axios.delete("api/users/" + data + "").then(() => {
            this.users.splice(index, 1);
          });
        } else {
          this.$swal("پەشمان بویتەوە", "", "info");
        }
      });
    },
    loadSingleUser(id){
      this.formUpdate.reset();
         axios.get("api/users/"+id+"").then(({ data }) => {
           this.formUpdate.fill(data.user);
           this.updateModal=true;
      });
    },
    updateUser(id){
     this.formUpdate.put('api/users/'+id+'').then(()=>{
       Load.$emit('newUser');
       this.updateModal=false;
     })
    }
  },
  created() {
    this.loadUser();
    Load.$on("newUser", () => {
      this.loadUser();
    });
  },
};
</script>