<template>
  <aside class="ml-[-100%] fixed z-10 top-0 pb-3 px-4 w-full flex flex-col justify-between h-screen border-r border-slate-600 bg-slate-700 transition duration-300 md:w-4/12 lg:ml-0 lg:w-[25%] xl:w-[20%] 2xl:w-[15%]">
    <div>
        <slot name="sidebar" />
    </div>
  </aside>

  <div class="ml-auto mb-5 lg:w-[75%] xl:w-[80%] 2xl:w-[85%]">
    <div class="pt-6">
        <main>
            <slot />
        </main>
    </div>
  

    <div class="fixed z-20 lg:w-[75%] xl:w-[80%] 2xl:w-[85%] bottom-0 h-28 bg-slate-800 bg-opacity-60 shadow-2xl lg:py-2.5"> 
        <slot name="form" />
    </div>
</div>
</template>

<script>
export default {

}
</script>

<style>

</style>