<template>
  <div class="form-group">
    <input
      v-model="val"
      type="email"
      class="form-control input-sm"
    >
  </div>
</template>

<script>

export default {
  props: {
    field: {
      type: String,
      required: true
    },
    guid: {
      type: String,
      required: true
    },
    value: {
      type: String,
      default: ''
    }
  },
  data () {
    return {
      val: this.value
    }
  },
  watch: {
    val () {
      this.$emit('input-value-updated', this.field, this.guid, this.val)
    }
  }
}
</script>
