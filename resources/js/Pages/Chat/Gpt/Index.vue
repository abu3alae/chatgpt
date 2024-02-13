<script setup>
import ChatLayout from '@/Layouts/ChatLayout.vue';
import { useForm } from '@inertiajs/vue3';

const form = useForm({
  prompt: ''
});

const submit = () => {
  const response = form.post(route('chat.gpt.store'));
  console.log(response);
}
</script>


<template>
  <ChatLayout>
    <template #sidebar>
        
    </template>
    <div class="w-full flex text-white">
            
    </div>
    <template #form>
      <section class="px-4 top-0">
        <div class="w-full">
          <div class="relative flex-1 flex items-center">
            <input 
              type="text" 
              class="w-full bg-white rounded-lg" 
              placeholder="Ask me anything !" 
              v-model="form.prompt"
              @keyup="submit"
            />
            <div class="absolute inset-y-0 right-0 flex items-center pl-3">
              <svg 
                xmlns="http://www.w3.org/2000/svg" 
                viewBox="0 0 512 512"
                class="h-6 w-6 -ml-7 text-slate-700 mr-2"
                @click="submit"
              >

                <path d="M498.1 5.6c10.1 7 15.4 19.1 13.5 31.2l-64 416c-1.5 9.7-7.4 18.2-16 23s-18.9 5.4-28 1.6L284 427.7l-68.5 74.1c-8.9 9.7-22.9 12.9-35.2 8.1S160 493.2 160 480V396.4c0-4 1.5-7.8 4.2-10.7L331.8 202.8c5.8-6.3 5.6-16-.4-22s-15.7-6.4-22-.7L106 360.8 17.7 316.6C7.1 311.3 .3 300.7 0 288.9s5.9-22.8 16.1-28.7l448-256c10.7-6.1 23.9-5.5 34 1.4z"/>
              </svg>
            </div>
          </div>
        </div>
      </section>
    </template>
  </ChatLayout>
</template>
