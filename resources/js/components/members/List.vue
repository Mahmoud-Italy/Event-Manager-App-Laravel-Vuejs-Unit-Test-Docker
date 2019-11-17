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
                  <li class="breadcrumb-item active" aria-current="page">{{ $t('members.title') }}</li>
                </ol>
              </nav>

              <div class="row" v-if="pgLoading">
                <div class="loader"></div>
              </div>

              <div class="row" v-if="!pgLoading" style="display: unset">
                <div v-if="something_went_wrong" class="something_went_wrong">
                    <h5>{{ $t('app.something_went_wrong') }}</h5>
                    <button class="btn btn-primary" style="border-radius: 20px" @click="fetchData()">
                      <i class="fa fa-refresh f14"></i> {{ $t('app.try_again') }}
                    </button>
                </div>
              </div>

              <div class="row" v-if="!pgLoading && !something_went_wrong">
                <div class="col-md-12 grid-margin stretch-card">
                  <div class="card">
                    <div class="card-body">
                      <h6 class="card-title">{{ $t('app.all_data') }} ( {{ total_data }} )</h6>
                      
                      <div class="table-responsive">
                          <table class="table table-hover">
                            <thead>
                              <tr>
                                <th class="text-center" style="width:5%">#</th>
                                <th class="text-center" style="width:10%">{{ $t('members.image') }}</th>
                                <th class="text-center" style="width:15%">{{ $t('members.name') }}</th>
                                <th class="text-center" style="width:15%">{{ $t('members.email') }}</th>
                                <th class="text-center" style="width:15%">{{ $t('members.registerd_at') }}</th>
                                <th class="text-center" style="width:10%">{{ $t('app.actions') }}</th>
                              </tr>
                            </thead>
                            <tbody v-if="dataLoading">
                                <tr ><td colspan="6"><div class="loader sm-loader" style="left: 50%"></div></td></tr>
                            </tbody>
                            <tbody v-if="!dataLoading">
                              <tr v-if="total_data == 0"><td colspan="6" class="text-center"> {{ $t('app.no_data') }}</td></tr>
                              <tr v-if="total_data != 0" v-for="(row, index) in rows" :key="index" v-bind:key="row.id" :ref="'row_'+row.id"
                                  :class="(row.status == 0) ? 'deactive' : 'active'">
                                  <td class="text-center">{{ index+1 }}</td>
                                  <td class="text-center">
                                    <img v-if="row.image !== null" :src="row.image" v-bind:style="{'width':'50px','height':'50px'}">
                                  </td>
                                  <td class="text-center">{{ row.name }}</td>
                                  <td class="text-center">{{ row.email }}</td>
                                  <td class="text-center">{{ row.created_at }}</td>
                                  <td class="text-center">
                                      <button type="button" class="btn" :class="(row.status === 1) ? 'btn-secondary' : 'btn-light' "
                                              @click="row.active_loading = true; activeData(row.id)" :disabled="row.active_loading">
                                            <span v-if="row.status === 0 && !row.active_loading">{{ $t('app.active') }}</span>
                                            <span v-if="row.status === 1 && !row.active_loading">{{ $t('app.deactive') }}</span>
                                            <span v-if="row.active_loading"><div class="loader sx-loader"></div></span>
                                      </button>
                                      <button type="button" class="btn" :class="(row.suspend === 1) ? 'btn-info' : 'btn-warning' "
                                              @click="row.suspend_loading = true; suspendData(row.id)" :disabled="row.suspend_loading">
                                            <span v-if="row.suspend === 0 && !row.suspend_loading">{{ $t('app.suspend') }}</span>
                                            <span v-if="row.suspend === 1 && !row.suspend_loading">{{ $t('app.restore') }}</span>
                                            <span v-if="row.suspend_loading"><div class="loader sx-loader"></div></span>
                                      </button>
                                      <button type="button" class="btn btn-danger"
                                              @click="row.del_loading = true;  deleteData(row.id)" :disabled="row.del_loading">
                                            <span v-if="!row.del_loading">{{ $t('app.delete') }}</span>
                                            <span v-if="row.del_loading"><div class="loader sx-loader"></div></span>
                                      </button>
                                    <p style="margin-top: 5px">
                                      <button type="button" class="btn btn-primary"
                                              @click="meetingData(row.id)">
                                            <span>{{ $t('meetings.name') }}</span>
                                      </button>
                                      <button type="button" class="btn btn-success"
                                            @click="callData(row.id)">
                                            <span>{{ $t('calls.name') }}</span>
                                      </button>
                                    </p>
                                  </td>
                              </tr>
                            </tbody>
                          </table>
                      </div>

                        <nav  v-if="total_data !== 0" aria-label="Page navigation example" v-bind:style="{'margin-top':'20px'}">
                            <ul class="pagination">
                                <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item">
                                    <a class="page-link" href="javascript:" @click="fetchData(pagination.prev_page_url)">Previous</a></li>
                                <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item">
                                    <a class="page-link" href="javascript:" @click="fetchData(pagination.next_page_url)">Next</a></li>
                            </ul>
                            <p><i>Page {{ pagination.current_page }} or {{ pagination.last_page }}</i></p>
                        </nav>

                    </div>
                  </div>
                </div>
              </div>
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
    name: 'Meetings',
    components: {
      Navigation,
      Header,
      Footer
    },
    mounted() {},
    data() {
        return {
          pgLoading: true,
          dataLoading: true,
          btnLoading: false,
          something_went_wrong: false,
          total_data: 0,
          rows: [],
          pagination: {},
          search: '',
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
      if(this.$route.query['search']) {
        this.search = this.$route.query['search'];
      }
      this.fetchData();
    },
    methods: {
      fetchData(page_url) {
          this.dataLoading = true;
          this.something_went_wrong = false;
          axios.defaults.headers.common = {
              'X-CSRF-TOKEN': this.csrfToken
          };
          const config = { headers: { 'Content-Type': 'multipart/form-data' }};  
          let vm = this;
          let formData = new FormData();
          formData.append('search', this.search);
          formData.append('accessToken', this.accessToken);
          page_url = page_url || '/api/v1/members';
          axios.post(page_url, formData, config)
            .then(res => {
                this.pgLoading = false;
                this.dataLoading = false;
                this.rows = res.data.data;
                if(res.data.meta.total) {
                  this.total_data = res.data.meta.total;
                  vm.makePagination(res.data.meta)
                }
            })
            .catch(err => {
                this.dataLoading = false;
                this.something_went_wrong = true;
            });
        },
        makePagination(meta) {
            let pagination = {
                current_page: meta.current_page,
                last_page: meta.last_page,
                next_page_url: meta.next_page_url,
                prev_page_url: meta.prev_page_url
            }
            this.pagination = pagination;
        },
        activeData(id) {
            axios.defaults.headers.common = {
                'X-CSRF-TOKEN': this.csrfToken
            };
            const config = { headers: { 'Content-Type': 'multipart/form-data' }};  
            let formData = new FormData();
            formData.append('rowId', id);
            formData.append('modelName', 'User');
            formData.append('accessToken', this.accessToken);
            axios.post('/api/v1/row/status', formData, config)
                .then(res => {
                this.fetchData();
                this.$noty.info(this.$i18n.messages[this.$i18n.locale].app.success_msg);
             })
              .catch(err => {
                this.$noty.error(this.$i18n.messages[this.$i18n.locale].app.error_msg);
            });
        },
        suspendData(id) {
            axios.defaults.headers.common = {
                'X-CSRF-TOKEN': this.csrfToken
            };
            const config = { headers: { 'Content-Type': 'multipart/form-data' }};  
            let formData = new FormData();
            formData.append('user_id', id);
            formData.append('accessToken', this.accessToken);
            axios.post('/api/v1/member/suspend', formData, config)
                .then(res => {
                this.fetchData();
                this.$noty.info(this.$i18n.messages[this.$i18n.locale].app.success_msg);
             })
              .catch(err => {
                this.$noty.error(this.$i18n.messages[this.$i18n.locale].app.error_msg);
            });
        },
        meetingData(id) {
          this.$router.push({ name: 'member-meetings', params: {id:id} })
        },
        callData(id) {
          this.$router.push({ name: 'member-calls', params: {id:id} })
        },
        deleteData(id) {
          if(confirm('Are You Sure?')) {
            axios.defaults.headers.common = {
                'X-CSRF-TOKEN': this.csrfToken
            };
            const config = { headers: { 'Content-Type': 'multipart/form-data' }};  
            let formData = new FormData();
            formData.append('user_id', id);
            formData.append('accessToken', this.accessToken);
            formData.append('_method', 'DELETE');
            axios.post('/api/v1/member/destroy', formData, config)
                .then(res => {
                this.fetchData();
                this.$noty.info(this.$i18n.messages[this.$i18n.locale].app.success_msg);
             })
              .catch(err => {
                this.$noty.error(this.$i18n.messages[this.$i18n.locale].app.error_msg);
            });
          }
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
    .deactive { background-color: #f9fafb }
    .sm-loader { width:40px;height:40px;border:2px solid #f3f3f3;border-top:2px solid transparent;position:relative;left:0%;margin-top: -4px }
    .sx-loader { width:20px;height:20px;border:2px solid #f3f3f3;border-top:2px solid #000;position:relative;left:5%; margin-top: -4px}
</style>