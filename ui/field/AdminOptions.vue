<template>
  <div class="flex-col">
    <label for="form-passwordField" class="text-lg font-normal text-gray-700 w-auto">
      Password Field
      <span class="text-sm text-red-500 font-bold">*</span>
    </label>

    <SelectField
      id="form-passwordField"
      :class="{ 'border-red-500': hasError, 'border-gray-300': !hasError }"
      v-model="passwordField"
    >
      <template v-slot:options>
        <option :value="null"></option>
        <option
          v-for="row in fields"
          :key="`passwordfield-${row.id}`"
          :value="row.id"
        >
          {{ row.name }}
        </option>
      </template>
    </SelectField>

    <template v-if="errorsList.length">
      <span v-for="error in errorsList" :key="error" class="border-red-700 block px-2 py-2 text-sm text-red-100 bg-red-500">
        {{ error }}
      </span>
    </template>
  </div>
</template>

<script>
import { get } from 'lodash'
import SelectField from '@/Adaptcms/Base/ui/components/Form/SelectField'

export default {
  props: [
    'modelValue',
    'field',
    'package',
    'errors',
    'fields'
  ],

  emits: [
    'update:modelValue'
  ],

  components: {
    SelectField
  },

  watch: {
    modelValue (newVal, oldVal) {
      if ((newVal !== oldVal) && get(newVal, 'passwordField', null)) {
        this.passwordField = newVal.passwordField
      }
    },

    passwordField (newVal, oldVal) {
      if (newVal !== oldVal) {
        this.$emit('update:modelValue', { passwordField: newVal })
      }
    }
  },

  computed: {
    hasError () {
      let key = 'meta.passwordField'

      return (typeof this.errors[key] !== 'undefined')
    },

    errorsList () {
      let key = 'meta.passwordField'

      return (typeof this.errors[key] !== 'undefined' ? this.errors[key].messages : [])
    }
  },

  data () {
    return {
      passwordField: null
    }
  },

  mounted () {
    if (!this.passwordField && get(this.value, 'passwordField', null)) {
      this.passwordField = this.modelValue.passwordField
    }
  }
}
</script>
