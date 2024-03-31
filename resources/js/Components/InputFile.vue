<template>
    <div>
        <input id="file" class="hide-file-input" type="file" accept="image/*" @change="onFileChange($event)" />
        <label class="file-label" for="file"> Upload a file </label>
    </div>
</template>

<script setup>

const emit = defineEmits(['file-updated']);

const onFileChange = ($event) => {
    const file = $event.target.files[0];
    const reader = new FileReader();
    if (file) {
        reader.readAsDataURL(file);
        reader.onload = (event) => {
            // Set a new property on the captured `file` and set it to the converted base64 image
            //file.previewBase64 = reader.result;
            //file.base = file;
            // Emit the file with the new previewBase64 property on it
            emit('file-updated', { previewBase64:reader.result, file:file });
        }
        reader.onerror = (error) => {
            console.log('Error ', error);
        }
    }
}
</script>

<style scoped>
.hide-file-input {
    position: absolute;
    width: 1px;
    height: 1px;
    padding: 0;
    margin: -1px;
    overflow: hidden;
    clip: rect(0, 0, 0, 0);
    white-space: nowrap;
    border-width: 0;
}

.file-label {
    color: #fff;
    background-color: #3730a3;
    padding: 0.5rem 1rem;
    border-radius: 0.25rem;
    cursor: pointer;
}

input[type='file']:focus+.file-label {
    box-shadow: 0 0 0 4px #bae6fd;
}
</style>