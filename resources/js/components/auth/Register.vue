<template>
    <div class="">

    <body class="">
      <div class="main-wrapper">

      <div class="page-wrapper full-page">
        <div class="page-content d-flex align-items-center justify-content-center">
          <div class="row w-80 mx-0 auth-page">
            <div class="col-md-8 col-xl-6 mx-auto">
              <div class="card">
                <div class="row">


                <div class="col-md-1"></div>
                <div class="col-md-10 pl-md-0">
                  <div class="auth-form-wrapper px-4 py-5">
                    <center>
                      <router-link :to="{ name: 'login' }">
                        <img src="/assets/images/logo-black.png" style="width: 250px; margin-top: -10px;margin-bottom: 30px" alt="">
                      </router-link>
                    </center>

                     <form @submit.prevent="register" class="forms-sample">
                      <div class="form-group">
                        <label for="txt1">{{ $t('auth.name') }}</label>
                        <input type="text" class="form-control" id="txt1" v-model="row.name" required>
                      </div>
                      <div class="form-group">
                        <label for="txt2">{{ $t('auth.email_address') }}</label>
                        <input type="text" class="form-control" id="txt2" v-model="row.email" required>
                      </div>
                      <div class="form-group">
                        <label for="txt3">{{ $t('auth.password') }}</label>
                        <input type="password" class="form-control" id="txt3"  v-model="row.password" autocomplete="off" required>
                      </div>
                      <div class="mt-3">
                        <button type="submit" class="btn btn-dark mr-2 mb-2 mb-md-0">
                          <span v-if="!btnLoading">{{ $t('auth.register') }}</span>
                          <div class="loader sm-loader" v-if="btnLoading"></div>
                        </button>
                      </div>
                      <router-link :to="{ name: 'login' }" class="d-block mt-3 text-muted">{{ $t('auth.already_user') }} {{ $t('auth.login') }}</router-link>
                    </form>

                  </div>
                </div>
                 <div class="col-md-1"></div>


                 </div>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </body>

    </div>
</template>

<script>
    export default {
      mounted() {},
      data() {
        return {
          row : {
            name: '',
            email: '',
            password: '',
          },
          pgLoading: false,
          btnLoading: false,
          something_went_wrong: false,
          csrfToken: '',
          accessToken: '',
        }
      },
      computed: {},
      created() {
         //
      },
      methods: {
        register() {
            this.btnLoading = true;
            axios.defaults.headers.common = {
                'X-CSRF-TOKEN': this.csrfToken
            };
            const config = { headers: { 'Content-Type': 'multipart/form-data' }};  
            let formData = new FormData();
            formData.append('name', this.row.name);
            formData.append('email', this.row.email);
            formData.append('password', this.row.password);
            axios.post('/api/v1/register', formData, config)
            .then(res => {
                this.btnLoading = false;
                this.row.password = '';
              if(res.data.statusCode == 200) {
                  localStorage.setItem('accessToken', res.data.accessToken);
                  this.$router.push({ name: 'dashboard' })
              } else {
                  this.$noty.error("Opps, <br/>"+res.data.err);
              }
            })
            .catch(err => {
              this.btnLoading = false;
              this.row.password = '';
              this.$noty.error(this.$i18n.messages[this.$i18n.locale].app.error_msg);
            });
          },
        }
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
    .sx-loader { width:20px;height:20px;border:2px solid #f3f3f3;border-top:2px solid #000;position:relative;left:5%; margin-top: -5px}
</style>