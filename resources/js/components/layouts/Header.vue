<template>
    <div class="">

         <nav class="navbar">
                <a href="#" class="sidebar-toggler">
                    <i class="fa fa-ellipsis-v icon-fixed"></i>
                </a>
                <div class="navbar-content">
                    <form class="search-form" method="get">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fa fa-search icon-fixed"></i>
                                </div>
                            </div>
                            <input type="text" class="form-control fontana" id="navbarForm" :placeholder="$t('app.search')" name="search" v-model="search">
                        </div>
                    </form>
                    <ul class="navbar-nav">

                        <li class="nav-item dropdown nav-profile">
                            <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img v-if="user.image" :src="user.image" :alt="user.name" style="width: 35px;height: 35px">
                                <img v-if="!user.image" src="/assets/images/avatar.png" :alt="user.name" style="width: 35px;height: 35px">
                            </a>
                            <div class="dropdown-menu" aria-labelledby="profileDropdown">
                                <div class="dropdown-header d-flex flex-column align-items-center">
                                    <div class="figure mb-3">
                                        <img v-if="user.image" :src="user.image" :alt="user.name" style="width: 65px;height: 65px">
                                        <img v-if="!user.image" src="/assets/images/avatar.png" :alt="user.name" style="width: 65px;height: 65px">
                                    </div>
                                    <div class="info text-center">
                                        <p class="name font-weight-bold mb-0 fontana">{{ user.name }}</p>
                                        <p class="email text-muted mb-3 fontana">{{ user.email }}</p>
                                    </div>
                                </div>
                                <div class="dropdown-body">
                                    <ul class="profile-nav p-0 pt-3">
                                        <li class="nav-item">
                                            <a @click="logOut()" class="nav-link pointer">
                                                <i data-feather="log-out"></i>
                                                <i class="fa fa-power-off icon-fixed"></i>
                                                <span class="fontana">{{ $t('app.logout') }}</span>
                                            </a>
                                        </li>
                                    </ul>

                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>

            
    </div>
</template>

<script>  
  export default {
    name: 'Header',
    mounted() {},
    data() {
        return {
            user: {
                user_id: '',
                image: '',
                name: '',
                email: '',
                is_admin: '',
            },
            search: '',
            csrfToken: '',
            accessToken: '',
        }
    },
    computed: {},
    created() {
      if(localStorage.getItem('accessToken')) {
        this.accessToken = localStorage.getItem('accessToken');
      }
      if(this.$route.query['search']) {
        this.search = this.$route.query['search'];
      }
      this.fetchUser();
    },
    methods: {
      fetchUser() {
          axios.defaults.headers.common = {
              'X-CSRF-TOKEN': this.csrfToken
          };
          const config = { headers: { 'Content-Type': 'multipart/form-data' }};  
          let formData = new FormData();
          formData.append('accessToken', this.accessToken);
          axios.post('/api/v1/fetch/user', formData, config)
            .then(res => {
               this.user.user_id = res.data.row.id,
               this.user.image = res.data.row.image;
               this.user.name = res.data.row.name;
               this.user.email = res.data.row.email;
               this.user.is_admin = res.data.row.is_admin;
            })
            .catch(err => {
              this.something_went_wrong = true;
          });
        },
        logOut() {
            localStorage.removeItem('accessToken');
            this.$router.push('/');
        },
    }
  }
</script>