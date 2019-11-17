<template>
    <div class="">

    <body class="sidebar-dark">
      <div class="main-wrapper">

         <Navigation></Navigation>
          <div class="page-wrapper">
          <Header></Header>

            <div class="page-content">
              <nav class="page-breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><router-link :to="{ name: 'dashboard' }">{{ $t('app.dashboard') }}</router-link></li>
                  <li class="breadcrumb-item active" aria-current="page">{{ $t('settings.name') }}</li>
                </ol>
              </nav>

              <div class="row" v-if="pgLoading">
                <div class="loader" ></div>
              </div>

              <div class="row" v-if="!pgLoading" style="display: unset">
                <div v-if="something_went_wrong" class="something_went_wrong">
                    <h5>{{ $t('app.something_went_wrong') }}</h5>
                    <button class="btn btn-primary" style="border-radius: 20px" @click="fetchData()">
                      <i class="fa fa-refresh f14"></i> {{ $t('app.try_again') }}
                    </button>
                </div>
              </div>

            <form @submit.prevent="update" enctype="multipart/form-data">
              <div class="row" v-if="!pgLoading && !something_went_wrong">

                  <div class="col-md-8 grid-margin stretch-card">
                    <div class="card">
                      <div class="card-body">
                          <div class="form-group">
                            <label for="txt1">{{ $t('settings.title') }}</label>
                            <input type="text" class="form-control" id="txt1" v-model="row.title">
                          </div>
                          <div class="form-group">
                            <label for="txt2">{{ $t('settings.email') }}</label>
                            <input type="text" class="form-control" id="txt2" v-model="row.email">
                          </div>
                          <div class="form-group">
                            <label for="txt3">{{ $t('settings.mobile') }}</label>
                            <input type="text" class="form-control" id="txt3" v-model="row.mobile">
                          </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-4 grid-margin">
                    <div class="card">
                      <div class="card-body">
                        <label for="txt5">{{ $t('settings.logo') }}</label>
                        <img v-if="row.logo && !row.preview" :src="row.logo" class="image">
                        <img v-if="!row.logo" :src="row.preview" class="image">
                        <input type="file" ref="myDropify" v-on:change="onImageChange"/>
                      </div>
                    </div>
                  </div>


                <div class="col-md-12 grid-margin stretch-card">
                  <div class="form-group">
                      <button class="btn btn-primary" :disabled="btnLoading">
                        <span v-if="!btnLoading">{{ $t('app.submit') }}</span>
                        <div class="loader sm-loader" v-if="btnLoading"></div>
                      </button>
                      <button type="button" class="btn btn-danger" @click="cancel()">{{ $t('app.cancel') }}</button>
                  </div>
                </div>

              </div>
             </form>

            

            </div>
          <Footer></Footer>
          </div>
        </div>
      </body>

    </div>
</template>

<script>
  import Navigation from '../layouts/Navigation.vue';
  import Header from '../layouts/Header.vue';
  import Footer from '../layouts/Footer.vue';

  export default {
    name: 'App',
    components: {
      Navigation,
      Header,
      Footer
    },
    mounted() {},
    data() {
        return {
          row: {
            preview: '',
            logo: '',
            title: '',
            email: '',
            mobile: '',
          },
          pgLoading: true,
          btnLoading: false,
          something_went_wrong: false,
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
      this.fetchData();
    },
    methods: {
      fetchData() {
          this.pgLoading = true;
          this.something_went_wrong = false;
          axios.defaults.headers.common = {
              'X-CSRF-TOKEN': this.csrfToken
          };
          const config = { headers: { 'Content-Type': 'multipart/form-data' }};  
          let formData = new FormData();
          formData.append('accessToken', this.accessToken);
          axios.get('/api/v1/settings', formData, config)
            .then(res => {
                this.row.logo = res.data.row.logo;
                this.row.title = res.data.row.title;
                this.row.email = res.data.row.email;
                this.row.mobile = res.data.row.mobile;
                this.pgLoading = false;
            })
            .catch(err => {
                this.pgLoading = false;
                this.something_went_wrong = true;
            });
        },
        onImageChange(e){
          const file = e.target.files[0];
          this.row.preview = URL.createObjectURL(file);
          this.row.image = file;
        },
        update() {
              this.btnLoading = true;
              axios.defaults.headers.common = {
                  'X-CSRF-TOKEN': this.csrfToken
              };
                const config = { headers: { 'Content-Type': 'multipart/form-data' }};  
                let formData = new FormData();
                formData.append('logo', this.row.image);
                formData.append('title', this.row.title);
                formData.append('email', this.row.email);
                formData.append('mobile', this.row.mobile);
                formData.append('accessToken', this.accessToken);
                axios.post('/api/v1/settings', formData, config)
                .then(res => {
                    this.btnLoading = false;
                    if(res.data.statusCode == 201) {
                        this.$noty.info(this.$i18n.messages[this.$i18n.locale].app.success_msg);
                    } else {
                        this.$noty.error(this.$i18n.messages[this.$i18n.locale].app.error_msg);
                    }
                })
                .catch(err => {
                    this.btnLoading = false;
                    this.$noty.error(this.$i18n.messages[this.$i18n.locale].app.error_msg);
                });
            },
            cancel() {
               this.$router.push({ name: 'dashboard' })
            }
    },
  }
</script>


<style scoped="">
    .loader {
        position: absolute;
        left: 56.5%;
        transform: translate(-50%, -50%);
        border: 3px solid #f3f3f3;
        border-top: 3px solid #686767;
        border-radius: 50%;
        width: 50px;
        height: 50px;
        animation: spin 1s linear infinite;
    }
    @keyframes spin {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
    }
    .sm-loader { width:20px;height:20px;border:2px solid #f3f3f3;border-top:2px solid transparent;position:relative;left:0%;margin-top: -4px }
    .image { width: 100%; height: 200px; margin-bottom: 5px; border-color: transparent }
</style>
