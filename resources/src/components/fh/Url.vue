<template>
  <div
    :class="{'required': isRequired}"
    class="form-group"
  >
    <label
      v-if="label !== ''"
      :for="guid"
      class="control-label"
    >
      {{ label }}
    </label>
    <input
      v-model="val"
      type="url"
      :class="[size]"
      class="form-control"
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
    },
    label: {
      type: String,
      default: '',
      required: false
    },
    size: {
      type: String,
      default: '',
      required: false
    },
    isRequired: {
      type: Boolean,
      default: false,
      required: false
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
