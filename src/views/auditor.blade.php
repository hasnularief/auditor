<!DOCTYPE html>
<html>
<head>
	<title>AUDITOR</title>
	<script src="{{url('plugins/vue.js')}}"></script>
	<script src="{{url('plugins/axios.min.js')}}"></script>
	<style type="text/css">
		body {font-family: Tahoma; font-size: 11px; } h1, h2, h3, h4, h5, h6 {padding: 2px; margin: 0px; } table {font-size: 11px; border-collapse: collapse; } table tr td {font-family: Tahoma; padding: 2px; } table tr th {font-family: Tahoma; font-weight: bold; background-color: #eee; padding: 2px; } tbody td{vertical-align: top; } tbody p{margin: 0; } pre{ display: block; word-break: break-all; word-wrap: break-word; } input, textarea, select, button { font: 11px Tahoma; }
	</style>
</head>
<body>
	<div id="v-app">
		@verbatim
		<h1>Auditor <small>&nbsp;[Page: {{models.current_page}}, Total Page: {{models.last_page}}, Records: {{models.total}} ]</small> <small v-if="loading">&nbsp;&nbsp;&nbsp;loading...</small></h1>
		<table width="100%" border="1">
			<thead>
				<tr>
					<th>#</th>
					<th>user_name</th>
					<th>table_name</th>
					<th>request_path</th>
					<th>request_param</th>
					<th>model_id</th>
					<th><label><input type="checkbox" v-model="expand_model"> model</label></th>
					<th>created_at</th>
				</tr>
				<tr>
					<th><input style="width: 30px;" @keyup.enter="read()" type="text" v-model="filters.id"></th>
					<th><input @keyup.enter="read()" type="text" v-model="filters.user_name"></th>
					<th><input @keyup.enter="read()" type="text" v-model="filters.table_name"></th>
					<th><input @keyup.enter="read()" type="text" v-model="filters.request_path"></th>
					<th><input @keyup.enter="read()" type="text" v-model="filters.request_param"></th>
					<th><input style="width: 30px;" @keyup.enter="read()" type="text" v-model="filters.model_id"></th>
					<th><input @keyup.enter="read()" type="text" v-model="filters.model"></th>
					<th><input @keyup.enter="read()" type="text" v-model="filters.created_at"></th>
				</tr>
			</thead>
			<tbody>
				<tr v-for="m in models.data">
					<td>{{m.id}}</td>
					<td>{{m.user_name}}</td>
					<td>{{m.table_name}}</td>
					<td>{{(m.request_path)}}</td>
					<td><pre>{{render(m.request_param)}}</pre></td>
					<td>{{m.model_id}}</td>
					<td><pre v-if="expand_model">{{render(m.model)}}</pre></td>
					<td>{{m.created_at}}</td>
				</tr>
			</tbody>
		</table>
		@endverbatim
	</div>
	<script>
		var app = new Vue({
		  el: '#v-app',
		  data: {
		    filters:{
		    	id: null,
		    	user_name:null,
		    	table_name: null,
		    	request_path: null,
		    	request_param: null,
		    	model_id: null,
		    	model: null,
		    	created_at: null
		    },

		    models:{
		    	per_page: 100
		    },
			expand_model: true

		  },
		  created(){
		  	this.read()
		  },
		  methods:{
		  	render(myjson) {
		  		return JSON.parse(myjson)
		  	},
		  	
		  	read() {
		  		const vm = this
		  		vm.loading = true
		  		const param = {req: 'table', page: vm.models.per_page, page: vm.models.current_page, filters: vm.filters}
		  		axios.get(window.location.href, {params: param}).then(function(response){
		  			vm.$set(vm.$data, 'models', response.data)
		  			vm.loading = false
		  		})
		  	}
		  }
		});
	</script>
</body>
</html>