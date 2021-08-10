<template>
	<div class="dropdown">
		<button
			:disabled="!rowsLeft"
			class="btn btn-white waves-effect shadow-sm dropdown-toggle"
			type="button"
			id="dropdownLocalSearch"
			data-toggle="dropdown"
			aria-haspopup="true"
			aria-expanded="true"
		>
			<svg
				xmlns="http://www.w3.org/2000/svg"
				fill="none"
				viewBox="0 0 24 24"
				stroke="currentColor"
			>
				<path
					stroke-linecap="round"
					stroke-linejoin="round"
					stroke-width="2"
					d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"
				></path>
			</svg>
			<span>Filter</span>
		</button>
		<div
			class="dropdown-menu"
			aria-labelledby="dropdownLocalSearch"
			x-placement="bottom-start"
		>
			<a
				v-for="searchOption in rows"
				v-show="showRow(searchOption)"
				:key="searchOption.key"
				@click.prevent="enableSearch(searchOption.key)"
				class="dropdown-item"
				href="#"
			>
				{{ searchOption.label }}
			</a>
		</div>
	</div>
</template>

<script>
import filter from "lodash-es/filter";

export default {
	props: {
		rows: {
			type: Object,
			required: true,
		},

		new: {
			type: Array,
			default: () => [],
			required: false,
		},

		onAdd: {
			type: Function,
			required: true,
		},
	},

	computed: {
		rowsLeft() {
			return filter(this.rows, (row) => this.showRow(row)).length > 0;
		},
	},

	methods: {
		showRow(row) {
			if (row.key === "global") {
				return false;
			}

			if (this.new.includes(row.key)) {
				return false;
			}

			if (row.enabled) {
				return false;
			}

			return true;
		},

		enableSearch(key) {
			this.onAdd(key);
			// this.$refs["dropdown"].hide();
		},
	},
};
</script>

<style scoped>
.dropdown-menu {
	position: absolute;
	transform: translate3d(0px, 36px, 0px);
	top: 0px;
	left: 0px;
	will-change: transform;
}
svg {
	width: 20px;
}
.btn-white {
	background-color: #fff;
}
</style>
