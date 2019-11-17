<template>
    <div class="">
    
    <nav class="sidebar">
      <div class="sidebar-header">
        <router-link :to="{ name: 'dashboard' }">
          <center><img src="/assets/images/logo-white.png" style="width: 100px" alt=""></center>
        </router-link>
        <div @click="toggleMenu()" ref="sidebar-toggler" class="sidebar-toggler not-active">
          <span></span>
          <span></span>
          <span></span>
        </div>
      </div>

      <div class="sidebar-body" style="overflow-y: auto">
        <ul class="nav">

          <li class="nav-item nav-category fontana f14">{{ $t('nav.main') }}</li>
          <li class="nav-item"
            :class="{ 'active' : this.$route.path == '/dashboard' }">
            <router-link :to="{ name: 'dashboard' }" class="nav-link active">
              <i class="fa fa-fort-awesome icon-fixed"></i>
              <span class="link-title m-left15 fontana">{{ $t('nav.dashboard') }}</span>
            </router-link>
          </li>

          <li class="nav-item nav-category fontana f14">{{ $t('nav.events') }}</li>
          <li class="nav-item"
            :class="{ 'active' : this.$route.path == '/dashboard/meetings' ||  this.$route.path == '/dashboard/meeting/create' }">
            <router-link :to="{ name: 'meetings' }" class="nav-link">
              <i class="fa fa-handshake-o icon-fixed"></i>
              <span class="link-title m-left15 fontana">MEETINGS</span>
            </router-link>
          </li>
          <li class="nav-item" 
            :class="{ 'active' : this.$route.path == '/dashboard/calls' ||  this.$route.path == '/dashboard/call/create' }">
            <router-link :to="{ name:'calls' }" class="nav-link">
              <i class="fa fa-phone icon-fixed"></i>
              <span class="link-title m-left15 fontana">CALLS</span>
            </router-link>
          </li>
          
          <li class="nav-item nav-category fontana f14" v-if="user.is_admin">USERS</li>
          <li class="nav-item" v-if="user.is_admin"
            :class="{ 'active' : this.$route.path == '/dashboard/members' }">
            <router-link :to="{ name:'members' }" class="nav-link">
              <i class="fa fa-male icon-fixed"></i>
              <span class="link-title m-left15 fontana">MEMBERS</span>
            </router-link>
          </li>
          
          <li class="nav-item nav-category fontana f14" v-if="user.is_admin">{{ $t('nav.settings') }}</li>
          <li class="nav-item"  v-if="user.is_admin"
            :class="{ 'active' : this.$route.path == '/dashboard/settings' }">
            <router-link :to="{ name:'settings' }" class="nav-link">
              <i class="fa fa-gear icon-fixed"></i>
              <span class="link-title m-left15 fontana">{{ $t('nav.settings') }}</span>
            </router-link>
          </li>


        </ul>
      </div>
    </nav>

        
    </div>
</template>

<script>  
  export default {
    name: 'Navigation',
    mounted() {},
    data() {
        return {
          settings: {
            logo: '',
          },
          user: {
            is_admin: false,
          },
          csrfToken: '',
          accessToken: '',
        }
    },
    computed: {},
    created() {
      if(localStorage.getItem('csrfToken')) {
        this.csrfToken = localStorage.getItem('csrfToken');
      }
      if(localStorage.getItem('accessToken')) {
        this.accessToken = localStorage.getItem('accessToken');
      }
      this.fetchUser();
    },
    methods: {
        fetchUser() {
          this.navLoading = true;
          axios.defaults.headers.common = {
              'X-CSRF-TOKEN': this.csrfToken
          };
          const config = { headers: { 'Content-Type': 'multipart/form-data' }};  
          let formData = new FormData();
          formData.append('accessToken', this.accessToken);
          axios.post('/api/v1/fetch/user', formData, config)
            .then(res => {
                this.user.is_admin = res.data.row.is_admin;
            })
            .catch(err => {
              this.navLoading = false;
              this.something_went_wrong = true;
          });
        },
        toggleMenu() {
          let para = document.querySelectorAll("body");
          let parax = para[para.length-1];
          let classes = parax.classList;
          if(parax.classList.contains('sidebar-folded')) {
            parax.classList.remove('sidebar-folded');
            $(this.$refs['sidebar-toggler']).removeClass('active').addClass('not-active');
          } else {
            parax.classList.add('sidebar-folded');
            $(this.$refs['sidebar-toggler']).removeClass('not-active').addClass('active');
          }
        },        
    }
  }
</script>

<style scoped="">
  .loader {
        position: absolute;
        left: 45%;
        transform: translate(-50%, -50%);
        border: 2px solid #f3f3f3;
        border-top: 2px solid #686767;
        border-radius: 50%;
        width: 30px;
        height: 30px;
        animation: spin 1s linear infinite;
    }
    @keyframes spin {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
    }
  .spin {
        animation: spin 3s linear infinite;
        color: #9b9b9b;
    }
  .cursor { cursor: pointer }
</style>
