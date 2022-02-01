<template>
  <div>
    <headers></headers>
    <div> 
      <div> 
        <div class="main-container" id="container"> 
          <div id="content" class="main-content">  
            <router-view></router-view>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import headers from "../components/header"
export default{
    components:{
        headers             
    },
    data() {
        return {
                               
        }

    },    
}
</script>