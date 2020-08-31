<template>
  <div class="w-100 mt-5">
    <div class="row">
      <div class="col-12 p-2">
        <div class="categorybox w-100 align-items-center py-1" @click="showAllDomains()">
          <h5 class="text-center">Show all links</h5>
        </div>
      </div>
      <div class="col-4 p-2 " v-for="category in this.categories" v-bind:key="category.id">
        <div class="categorybox w-100 align-items-center py-1" @click="selectedCat(category.id)">
          <h5 class="text-center">{{ category.category_name }}</h5>
        </div>
      </div>
    </div>
    <div class="row mt-5">
      <div
        class="col-4 p-2"
        v-for="subcategory in filteredSubcategories"
        v-bind:key="subcategory.id"
      >
        <div
          class="categorybox w-100 align-items-center py-1"
          @click="selectedSubcat(subcategory.id)"
        >
          <h6 class="text-center">{{ subcategory.subcategory_name}}</h6>
        </div>
      </div>
    </div>
    <div class="row mt-5">
      <div class="p-2 col-6" v-for="domain in this.filteredDomains" v-bind:key="domain.id">
        <div class="card">
          <div class="card-body">
            <p>
              <strong>Website name:</strong>
              {{domain.title}}
            </p>
            <p>
              <strong>Website url:</strong>
              <a :href="domain.url">{{ domain.url}}</a>
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["domains", "categories", "subcategories"],
  data() {
    return {
      selectedcategory: "",
      selectedsubcategory: "",
    };
  },
  methods: {
    selectedCat: function (id) {
      this.selectedcategory = id;
      this.selectedsubcategory = "";
    },
    selectedSubcat: function (id) {
      this.selectedsubcategory = id;
    },
    showAllDomains: function () {
      this.selectedcategory = "";
      this.selectedsubcategory = "";
    },
  },
  computed: {
    filteredSubcategories: function () {
      return this.subcategories.filter(
        (item) => item.category_id === this.selectedcategory
      );
    },
    filteredDomains: function () {
      if(this.selectedcategory === "" && this.selectedsubcategory === "") {
        return this.domains;
      }
      else if (this.selectedsubcategory !== "") {
        return this.domains.filter(
          (item) => item.category_id === this.selectedsubcategory
        );
      } else if (
        this.selectedcategory !== "" &&
        this.selectedsubcategory === ""
      ) {
        return this.domains.filter(
          (item) => item.subcategory_id === this.selectedcategory
        );
      } 
 
    },
  },
};
</script>
