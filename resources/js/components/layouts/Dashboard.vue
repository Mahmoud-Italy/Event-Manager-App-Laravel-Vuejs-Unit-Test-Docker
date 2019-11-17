<template>
    <div class="">

    <body class="sidebar-dark">
      <div class="main-wrapper">

        <Navigation></Navigation>
        <div class="page-wrapper">
          <Header></Header>

      <div class="page-content">
        <div class="row" v-if="pgLoading">
          <div class="loader"></div>
        </div>

        <div class="row" v-if="!pgLoading" style="display: unset">
          <div v-if="something_went_wrong" class="something_went_wrong">
              <h5 class="fontana">{{ $t('app.something_went_wrong') }}</h5>
              <button class="btn btn-primary fontana" style="border-radius: 20px" @click="fetchData()">
                <i class="fa fa-refresh f14"></i> {{ $t('app.try_again') }}
              </button>
          </div>
        </div>


        <div class="row" v-if="!pgLoading && !something_went_wrong">
          <div class="col-12 col-xl-12 grid-margin stretch-card">
            <div class="card overflow-hidden">
              <div class="card-body">
                <div class="d-flex justify-content-between align-items-baseline mb-4 mb-md-3">
                  <h6 class="card-title mb-0 fontana">{{ $t('app.events') }}</h6>
                </div>
                <div class="row align-items-start mb-2">
                  <div class="col-md-12">
                    <p class="text-muted tx-13 mb-3 mb-md-0 fontana">{{ $t('app.events_note') }}</p>
                  </div>
                </div>
                <div class="flot-wrapper">
                  <apexchart type=area  :options="chartOptions" :series="series" class="mt-md-3 mt-xl-0" height="400" />
                </div>
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
    name: 'App',
    components: {
      Navigation,
      Header,
      Footer
    },
    mounted() {},
    data() {
        return {
          chartOptions: {
            chart: { height: 400, zoom: { enabled: false }},
            animations: { enabled: true },
            dataLabels: {  enabled: false },
            stroke: {  curve: 'straight' },
            title: { text: '', align: 'center' },
            grid: {  row: { colors: ['#f3f3f3', 'transparent'],  opacity: 0.5 }},
            markers: { size: 5, align:top,  hover: {  sizeOffset: 5  }},
            xaxis: { categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul\n\r', 'Aug', 'Sep','Oct','Nov','Dec']}
          },
          series: [],
          pgLoading: true,
          dataLoading: false,
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
        this.fetchDay();
        this.fetchDashboard();
      },
      fetchDay() {
        const monthNames = ["January", "February", "March", "April", "May", "June","July", "August", "September", "October", "November", "December"];
        var d = new Date();
        this.day = d.getDate()+'-'+monthNames[d.getMonth()]+'-'+d.getFullYear();
      },
      fetchDashboard() {
         this.pgLoading = true;
          axios.defaults.headers.common = {
            'X-CSRF-TOKEN': this.csrfToken
          };
          const config = { headers: { 'Content-Type': 'multipart/form-data' }};  
          let formData = new FormData();
          formData.append('accessToken', this.accessToken);
          axios.post('/api/v1/dashboard', formData, config)
          .then(res => {
              this.pgLoading = false;
              if(res.data.statusCode == 200) {
                this.series = [{name:'Events', data: res.data.eventChart}];
              } else {
                this.pgLoading = false;
                this.something_went_wrong = true;
              }
          })
          .catch(err => {
              this.pgLoading = false;
              this.something_went_wrong = true;
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
</style>
