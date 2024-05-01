// globalComponents.ts
import { App as VueApp } from 'vue'
import Message from './components/Message.vue'

export function registerGlobalComponents(app: VueApp): void {
    app.component('Message', Message)
}