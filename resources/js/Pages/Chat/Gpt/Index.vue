<script setup>
import ChatLayout from '@/Layouts/ChatLayout.vue';
import { Link, useForm } from '@inertiajs/vue3';
import Content from '@/Components/Content.vue';

const props = defineProps({
  messages: Array,
  chat: null | Object
});

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
      <ul class="p-2" v-if="messages">
        <template v-for="message in messages" :key="message.id">
          <li class="px-4 py-2 my-2 flex justify-between font-semibold text-white bg-slate-700 hover:bg-slate-500 rounded-lg duration-150">
            <Link :href="route('chat.gpt', message.id)">
              {{ message.chat_content[0].content }}
            </Link>
          </li>
        </template>
      </ul>
        
    </template>
    <div class="w-full flex text-white">
     <template v-if="chat">
        <div class="w-full flex h-screen bg-slate-800">
          <div class="w-full overflow-auto pb-36">
            <template v-for="(content, index) in chat?.chat_content" :key="index">
              <Content :content="content" />
            </template>
          </div>
        </div>
      </template>
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
              @keyup.enter="submit"
              :disabled="form.processing"
            />
            <div class="absolute inset-y-0 right-0 flex items-center pl-3">
              <svg 
                xmlns="http://www.w3.org/2000/svg" 
                fill="none" 
                viewBox="0 0 24 24" 
                stroke-width="1.5" 
                stroke="currentColor" 
                class="h-6 w-6 -ml-7 text-slate-700 mr-2"
                v-if="!form.processing"
                @click="submit"
              >
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5" />
              </svg>
              <div class="loading -ml-10" v-if="form.processing"></div>
            </div>
          </div>
        </div>
      </section>
    </template>
  </ChatLayout>
</template>

<style scoped>
.loading {
  position: relative;
  left: -9999px;
  width: 12px;
  height: 10px;
  border-radius: 8px;
  background-color: #9880ff;
  color: #69072f;
  box-shadow: 9984px 0 0 0 #9880ff, 9999px 0 0 0 #9880ff, 10014px 0 0 0 #9880ff;
  animation: loading 1.5s infinite linear;
} 

@keyframes loading {
  0% {
        box-shadow: 9984px 0 0 0 #9880ff, 9999px 0 0 0 #be7c30,
        10014px 0 0 0 #9880ff;
    }
    16.667% {
        box-shadow: 9984px -10px 0 0 #9880ff, 9999px 0 0 0 #260b9d,
        10014px 0 0 0 #9880ff;
    }
    33.333% {
        box-shadow: 9984px 0 0 0 #9880ff, 9999px 0 0 0 #9880ff,
        10014px 0 0 0 #9880ff;
    }
    50% {
        box-shadow: 9984px 0 0 0 #9880ff, 9999px -10px 0 0 #9880ff,
        10014px 0 0 0 #9880ff;
    }
    66.667% {
        box-shadow: 9984px 0 0 0 #9880ff, 9999px 0 0 0 #6b0a5b,
        10014px 0 0 0 #9880ff;
    }
    83.333% {
        box-shadow: 9984px 0 0 0 #9880ff, 9999px 0 0 0 #fb80ff,
        10014px -10px 0 0 #9880ff;
    }
    100% {
        box-shadow: 9984px 0 0 0 #9880ff, 9999px 0 0 0 #410831,
        10014px 0 0 0 #9880ff;
    }
}
</style>
