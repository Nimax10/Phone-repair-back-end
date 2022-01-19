let app = new Vue({
	el: '#app',
	data: {
		phones: [],
		typesRepair: [],
		currentTimeMain: 5,
		currentImageMain: 0,
		timerMain: null,
		currentPage: 'main-page',
		callback: 'false',
		currentPhone: null,
		currentModel: null,
		typeRepair: 0,
		burgMenu: false,
	  },
	  created() {
		fetch('/api/ModelsData', {
			method: "GET",
			headers: {
				"Content-Type": "application/json"
			},
			credentials: "same-origin"
		})
		.then(response => response.json())
		.then(data => {
			// console.log(data) 
			this.phones = data
		})
		.catch(err => console.error(err))

		fetch('/api/TypesData', {
			method: "GET",
			headers: {
				"Content-Type": "application/json"
			},
			credentials: "same-origin"
		})
		.then(response => response.json())
		.then(data => {
			// console.log(data) 
			this.typesRepair = data
		})
		.catch(err => console.error(err))
	},
	  mounted() {
		this.starttimerMain()
	  },
	  destroyed() {
		this.stoptimerMain()
	  },
	  methods: {
		starttimerMain() {
		  this.timerMain = setInterval(() => {
			this.currentTimeMain--
		  }, 1000)
		},
		stoptimerMain() {
		  clearTimeout(this.timerMain)
		},
	  },
	  watch: {
		currentTimeMain(time) {
		  if (time === 0) {
			if (this.currentImageMain === 3) {
				this.currentTimeMain = 5
				this.currentImageMain = 0
			} else {
				this.currentTimeMain = 5
				this.currentImageMain++
			}
		  }
		}
	  },
})