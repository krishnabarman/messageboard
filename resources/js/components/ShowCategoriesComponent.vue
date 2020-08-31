<template>
  <div class="container">
    <div  v-for="category in this.categories" v-bind:key="category.id">
      <h4 >{{ category.category_name }}</h4>
      <ul>
        <li v-for="subcat in category.subcategories" v-bind:key="subcat.id">
            {{ subcat.subcategory_name }}
            </li>
      </ul>
    </div>
  </div>
</template>

<script>
export default {
  props: ["categories"],
  mounted() {
    console.log("Component mounted.");
  },
};
</script>
