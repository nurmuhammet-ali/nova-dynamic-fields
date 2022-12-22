<template>
  <div>
    <div v-for="userField in userFields">
      <DefaultField :field="currentFieldFor(userField.name)" :fieldName="userField.label" :errors="errors">
        <template #field>
          <template v-if="userField.type == 'select'">
            <select 
              :id="userField.name"
              v-model="values[userField.name]"
              class="w-full block form-control form-select form-select-bordered"
              disabled
            >
              <option value="">Saýla</option>
              <option v-for="option in userField.options" :value="option.value">
                {{ option.label }}
              </option>
            </select>
          </template>
          <template v-else>
            <input
              :id="userField.name"
              :type="userField.type"
              class="w-full form-control form-input form-input-bordered"
              :class="errorClasses"
              v-model="values[userField.name]"
              :placeholder="userField.placeholder"
              disabled
            />
          </template>

          <p v-if="hasError" class="my-2 text-danger">
            {{ firstError }}
          </p>
        </template>
      </DefaultField>
    </div>
  </div>
</template>

<script>
import { DependentFormField, HandlesValidationErrors } from 'laravel-nova'
import { capitalize } from 'lodash'

export default {
   mixins: [DependentFormField, HandlesValidationErrors],

  props: ['resourceName', 'resourceId', 'field'],

  data() {
    return {
      userFields: [],
      values: [],
      fillWithArrayName: '',
      value: '',
    }
  },

  methods: {
    /*
     * Set the initial, internal value for the field.
     */
    setInitialValue() {
      this.value = this.field.value || ''
    },

    setValueFor(name, value) {
      this.values[name] = value
    },

    currentFieldFor(name) {
      const new_field = JSON.parse(JSON.stringify(this.currentField))
      new_field.name = capitalize(name)

      let userField = this.userFields.filter(field => field.name == name)[0]
      
      if (userField['placeholder']) {
        new_field.placeholder = userField['placeholder']
      }

      return new_field
    }
  },

  computed: {
    placeholder() {
      return this.__('Choose an option')
    }
  },

  mounted() {
    this.fillWithArrayName = this.field.fillWithArrayName;

    this.userFields = this.field.fields.map(field => {
      this.values[field.name.toLowerCase()] = field.default ? field.default : ''

      return {
        type: field.type,
        name: field.name.toLowerCase(),
        label: field.label ? capitalize(field.label) :  capitalize(field.name),
        default: field.default,
        placeholder: field.placeholder,
        options: field.options
      }
    })
  }
}
</script>
