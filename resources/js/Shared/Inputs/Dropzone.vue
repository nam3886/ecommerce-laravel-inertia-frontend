<template>
  <form :class="{ multiple }" ref="dropzone" action="#" class="dropzone">
    <div class="fallback">
      <input name="file" type="file" multiple="multiple" />
    </div>
    <div class="dz-message needsclick">
      <div class="mb-3">
        <i class="display-4 text-muted bx bxs-cloud-upload"></i>
      </div>

      <h4>Drop files here or click to upload.</h4>
    </div>
  </form>
</template>

<script>
import Dropzone from "dropzone";
import isArray from "lodash-es/isArray";
import isObject from "lodash-es/isObject";
import { wait } from "@/helpers.js";

export default {
  props: {
    multiple: {
      type: Boolean,
      required: false,
      default: false,
    },

    options: {
      type: Object,
      required: false,
      default: () => ({}),
    },

    value: {
      type: [Array, Object, File],
      required: false,
    },
  },

  data() {
    return {
      dropzone: null,
    };
  },

  mounted() {
    const $vm = this;
    Dropzone.autoDiscover = false;
    this.dropzone = new Dropzone(this.$refs.dropzone, {
      maxFiles: 1,
      maxFilesize: 1,
      autoProcessQueue: false, // prevent upload server
      addRemoveLinks: true,
      dictRemoveFile: "",
      dictRemoveFileConfirmation: "Are you sure you want to remove this image?",
      init() {
        this.on("addedfile", function (file) {
          // prevent process upload server
          this.emit("complete", file);
        })
          .on("maxfilesexceeded", function (file) {
            // alert("No more files please!");
            // this.removeFile(file);
          })
          .on("complete", function (file) {
            $vm.handleUpdateFiles();
          })
          .on("removedfile", function (file) {
            $vm.handleUpdateFiles();
          });
      },
      ...this.options,
    });

    if (isArray(this.value)) {
      this.addExistingFilesFromServer(this.value);
    } else if (isObject(this.value)) {
      this.addExistingFileFromServer(this.value);
    }
  },

  methods: {
    addExistingFileFromServer(file) {
      const newFile = { ...file };
      this.dropzone.files.push(newFile);
      this.dropzone.emit("addedfile", newFile);
      this.dropzone.emit("thumbnail", newFile, newFile.url);
    },

    addExistingFilesFromServer(files) {
      const newFiles = [...files];
      newFiles.forEach((file) => this.addExistingFileFromServer(file));
    },

    handleUpdateFiles() {
      wait().then(() => {
        this.$emit("input", this.dropzone.getAcceptedFiles());
      });
    },
  },
};
</script>

<style scoped>
.dropzone {
  border: 2px dashed #ced4da;
  background: #fff;
  border-radius: 6px;
}
.dropzone .dz-message {
  font-size: 24px;
  width: 100%;
}
</style>