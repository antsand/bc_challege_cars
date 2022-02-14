<template>
	<div> 
		<div>
			Select Car Manufacturer:
			<select v-if="cars_data"i v-model="car_manufacturer">
				<option></option>
				<option v-for="car_manu in Object.keys(cars_data)" v-html="car_manu"></option>
			</select>	
			<button @click="search">
				Search Models
			</button>
		</div>
		<div>
			<div v-if="car_details">
				<ul>
					<li v-for="cars in car_details" v-html="cars">

					</li>
				</ul>	
			</div>	
		</div>
	</div>
</template>

<script>
 export default {
	data() {
		 return {
			cars_data:null,
			car_details: null,
			car_manufacturer: null,
		} 
	},
	watch: {
		car_details: {
			handler: function(newVal, oldVal ) {

			},
			deep:true
		}

	},
	methods: {
		search:function() {
			/* check if the car data  has property of car manufacturer
			   if not, the detrails should be null */	
			if (this.cars_data.hasOwnProperty(this.car_manufacturer))  {
				this.car_details = this.cars_data[this.car_manufacturer];
			} else {
				this.car_details = null;
			}
		}

	},
	mounted:function() {
     		var formData = new FormData();
	    	 this.$http.post('/cars/read', formData)
		.then(response => {                         
		  if (response.bodyText) {      
		      console.log(response.bodyText);	 
		      this.cars_data = JSON.parse(response.bodyText);
		  }      
		 }, error => { 
		      console.log(error);                                
		}               
	     );
	} 
}

</script>

