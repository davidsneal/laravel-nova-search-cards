Nova.booting((Vue, router, store) => {
  Vue.component('laravel-nova-latest-searches-card', require('./components/LatestSearchesCard'))
  Vue.component('laravel-nova-top-searches-card', require('./components/TopSearchesCard'))
})
