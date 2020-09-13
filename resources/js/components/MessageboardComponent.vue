<template>
  <div class="container mt-2">
    <ul class="nav nav-tabs">     
      <span
        class="tab"
        :class="{ activeTab: selectedTab === tab }"
        v-for="(tab,index) in tabs"
        v-show="(tab==='All Posts')||(userId!=='0' && tab==='My Posts')"
        v-bind:key="index"
        @click="selectedTab = tab"
      >{{ tab }}</span>
    </ul>

    <div class="container" id="1" v-show="selectedTab === 'All Posts'">
      <ul class="list-group list-group-flush">
        <div class="row" v-for="message in this.messageData" :key="message.id">
          <div class="col-md-1">
                    <img class="img-thumbnail" style="width: 100%" 
                    :src='"/storage/messageboard/cover_images/"+message.cover_image' 
                    :alt= "message.cover_image">
                </div>
                <div class="col-md-10">
                    <a :href='"/messageboard/"+ message.id'>  {{ message.title   }} </a> by {{ message.user.name }}
                </div>
          
          </div>
        </ul>
    
    </div>
    <div class="container" id="2" v-show="selectedTab === 'My Posts' && userId!=='0'">
      <p v-show="this.myPosts.length<1" > You dont have any post. </p>
      <ul class="list-group list-group-flush">
        <div class="row" v-for="message in this.myPosts" :key="message.id">
          <div class="col-md-1">
                    <img class="img-thumbnail" style="width: 100%" 
                    :src='"/storage/messageboard/cover_images/"+message.cover_image' 
                    :alt= "message.cover_image">
                </div>
                <div class="col-md-10">
                    <a :href='"/messageboard/"+ message.id'>  {{ message.title   }} </a> by {{ message.user.name }}
                </div>
          
          </div>
        </ul>
      </div>
  </div>
</template>
<script>

export default {  
  
  data:function() {
    return {
      tabs: ["All Posts", "My Posts"],
      selectedTab: "All Posts",      
      messageData:[],
      userId: this.$userId,      
     
    };
  },
  mounted() {
    this.loadMessages();
   
  },
  methods:{
    loadMessages: function(){
      axios.get('/messageboard')
      .then((response)=>{
       
        this.messageData = response.data.data;
      })
      .catch  (function(error){
        console.log(error);
      });

    }
  },
  computed:{
        myPosts: function () {
      return this.messageData.filter(
        (item) => String(item.user.id) === this.userId
      );
    },
  }

};
</script>
<style>
.tab {
  margin-left: 20px;
  cursor: pointer;
}

.activeTab {
  color: #16c0b0;
  text-decoration: underline;
}
</style>