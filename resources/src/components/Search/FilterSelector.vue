<template>
  <div>
    <div class="col-xs-4">
      <div class="form-group">
        <select
          v-model="model"
          class="form-control input-sm"
        >
          <option
            v-for="(item, itemIndex) in models"
            :key="itemIndex"
            :value="item"
          >
            {{ item }}
          </option>
        </select>
      </div>
    </div>
    <div class="col-xs-8">
      <div class="form-group">
        <select
          v-model="field"
          class="form-control input-sm"
          @change="create()"
        >
          <option value="">
            -- Add filter --
          </option>
          <template v-for="(item, itemIndex) in searchableFields">
            <option
              v-if="item.group === model"
              :key="itemIndex"
              :value="item.field"
            >
              {{ item.label }}
            </option>
          </template>
        </select>
      </div>
    </div>
  </div>
</template>
<script>
import { mapGetters, mapState } from 'vuex'

/**
 * In the future this can be moved as part of the TableAjax.vue component.
 */

export default {
  name: 'FilterSelector',
  data () {
    return {
      field: '',
      model: this.$store.state.search.model
    }
  },
  computed: {
    ...mapGetters({
      models: 'search/filterModels'
    }),
    ...mapState({
      fields: state => state.search.filters
    }),
    searchableFields () {
      let result = []

      if (this.fields.length) {
        result = this.fields.filter( item => item.searchable === true)
      }

      return result
    }
  },
  methods: {
    create () {
      this.$store.commit('search/criteriaCreate', { field: this.field })
      this.field = ''
    }
  }
}
</script>
