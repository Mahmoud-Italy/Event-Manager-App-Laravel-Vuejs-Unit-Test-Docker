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
                  <li class="breadcrumb-item active" aria-current="page">{{ $t('app.create_new') }}</li>
                </ol>
              </nav>

              <div class="row" v-if="pgLoading">
                <div class="loader"></div>
              </div>

              <div class="row" v-if="!pgLoading" style="display: unset">
                <div v-if="something_went_wrong" class="something_went_wrong">
                    <h5>{{ $t('app.something_went_wrong') }}</h5>
                    <button class="btn btn-primary"style="border-radius: 20px" @click="fetchData()">
                      <i class="fa fa-refresh f14"></i> {{ $t('app.try_again') }}
                    </button>
                </div>
              </div>

            <form @submit.prevent="addNew" enctype="multipart/form-data">
              <div class="row" v-if="!pgLoading && !something_went_wrong">

                  <div class="col-md-8 grid-margin stretch-card">
                    <div class="card">
                      <div class="card-body">
                          <div class="form-group">
                            <label for="txt1">{{ $t('calls.title') }}</label>
                            <input type="text" class="form-control" id="txt1" v-model="row.title" required="">
                          </div>
                        <div class="row col-12">
                          <div class="form-group col-6">
                            <label for="txt3">{{ $t('calls.start_dateTime') }}</label>
                            <date-picker v-model="row.start_dateTime" id="txt3" type="datetime" 
                                  style='width: 100%; height: 35px'></date-picker>
                          </div>
                          <div class="form-group col-6">
                            <label for="txt4">{{ $t('calls.end_dateTime') }}</label>
                            <date-picker v-model="row.end_dateTime" id="txt3" type="datetime"
                                style='width: 100%; height: 35px'></date-picker>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-4 grid-margin">
                    <div class="card">
                      <div class="card-body">
                        <label for="txt5">{{ $t('calls.image') }}</label>
                        <img :src="row.preview" class="image">
                        <input type="file" ref="myDropify" v-on:change="onImageChange"/>
                      </div>
                    </div>
                  </div>
              
                <div class="col-md-12 grid-margin stretch-card">
                  <div class="card">
                    <div class="card-body">
                       <h6 class="card-title">{{ $t('calls.content') }}</h6>
                      <vue-simplemde v-model="row.content" ref="markdownEditor" />
                    </div>
                  </div>
                </div>

                <div class="col-md-12 grid-margin stretch-card">
                  <div class="form-group">
                      <button class="btn btn-primary" :disabled="btnLoading">
                        <span v-if="!btnLoading">{{ $t('app.submit') }}</span>
                        <div class="loader sm-loader" v-if="btnLoading"></div>
                      </button>
                      <button type="button" class="btn btn-danger" @click="$router.go(-1)">{{ $t('app.cancel') }}</button>
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
  import VueSimplemde from 'vue-simplemde';
  import Dropdown from 'vue-simple-search-dropdown';
  import DatePicker from 'vue2-datepicker';
  import 'vue2-datepicker/index.css';

  export default {
    name: 'App',
    components: {
      Navigation,
      Header,
      Footer,
      VueSimplemde,
      DatePicker,
      Dropdown
    },
    mounted() {},
    data() {
        return {
          row: {
            preview: '',
            image: '',
            title: '',
            content: '',
            start_dateTime: '',
            end_dateTime: '',
          },
          pgLoading: false,
          btnLoading: false,
          tblLoading: false,
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
    },
    methods: {
        onImageChange(e){
          const file = e.target.files[0];
          this.row.preview = URL.createObjectURL(file);
          this.row.image = file;
        },
        addNew() {
              this.btnLoading = true;
              axios.defaults.headers.common = {
                  'X-CSRF-TOKEN': this.csrfToken
              };
                const config = { headers: { 'Content-Type': 'multipart/form-data' }};  
                let formData = new FormData();
                formData.append('image', this.row.image);
                formData.append('title', this.row.title);
                formData.append('content', this.row.content);
                formData.append('start_dateTime', this.row.start_dateTime);
                formData.append('end_dateTime', this.row.end_dateTime);
                formData.append('accessToken', this.accessToken);
                axios.post('/api/v1/call/create', formData, config)
                .then(res => {
                    this.btnLoading = false;
                    if(res.data.statusCode == 201) {
                        this.$noty.info(this.$i18n.messages[this.$i18n.locale].app.success_msg);
                        this.$router.push({ name: 'calls' })
                    } else {
                        this.$noty.error('Opps<br/>'+res.data.err);
                    }
                })
                .catch(err => {
                    this.btnLoading = false;
                    this.$noty.error(this.$i18n.messages[this.$i18n.locale].app.error_msg);
                });
            },
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
    .image { width: 100%; height: 185px; margin-bottom: 5px; border-color: transparent }
    .sm-loader { width:20px;height:20px;border:2px solid #f3f3f3;border-top:2px solid #000;position:relative;left:0%;margin-top: -4px }
    .sx-loader { width:20px;height:20px;border:2px solid #f3f3f3;border-top:2px solid #000;position:relative;left:5%; margin-top: -5px}
</style>
