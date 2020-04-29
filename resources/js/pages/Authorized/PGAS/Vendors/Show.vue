<template>
	<div>
		<!-- Import Item Progress Here:
				Props needed:
					- front_steps: Array from globals store vuex. Gawa ka muna ng array of statuses na nakikita sa progress bar (Create, Review, etc). See globals vuex for an example
					- db_steps: Array from globals store vuex. Gawa ka muna ng array of statuses na sinasave sa database (For Approval, For Review, etc.)
					- item: Prop na kinukuha mo sa axios. In this case yung makukuha mo sa axios.get("/api/vendor/{id}")
					- contributors: Create ka ng relationship table for vendors and contributors. A vendor hasMany contributors through sa contribution list. See Project Model and Project Contributor (I'll make this a polymorphic soon. for now, iapply mo nalang muna yung Vendor and VendorContributor relationship. Tignan mo nalang yung database structure ng project contributor, gayahin mo)
					- api_link: Hindi ko to inapply so ignore mo muna
					- remarks: May polymorphic relationship na ang remarks. Apply mo lang to sa Vendor Model mo:
							  public function remarks(){
								return $this->morphMany("App\Remark", 'remarkable')->with('returned_by');
							  }
					- mode: Use "Show" by default as a prop
					
		 -->

		 <!-- Import ShowProject Here 
		 		Props needed:
				 	- vendor: Vendor na makukuha mo sa api response callback
					- vendor_code: Add this sa Vendor model mo para magka code ka:
						  public function getCodeAttribute(){
							$year = date("y");
							return $year . "-".sprintf('%04d', $this->attributes['id']);
						}
						^^ Sample getter is for project. Change the code as needed depende sa format na binigay ni sir von sa Vendor Code
					- front_steps: As described earlier
					- contributors: As described earlier
		 -->
		

	</div>
</template>

<script>
export default {

}
</script>

<style>
</style>