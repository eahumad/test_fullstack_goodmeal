<template>
  <div>
    <slot></slot>
  </div>
</template>

<style scoped>
div {
  min-width: 10px;
  min-height: 10px;
  border-radius: var(--radius);
  box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
}
</style>
