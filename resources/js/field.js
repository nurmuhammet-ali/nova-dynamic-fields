import DetailField from './components/DetailField'
import FormField from './components/FormField'

Nova.booting((app, store) => {
  app.component('detail-dynamic-fields', DetailField)
  app.component('form-dynamic-fields', FormField)
})
