<template>
	<div class="dropdown">
		<button
			class="btn btn-white waves-effect shadow-sm dropdown-toggle"
			type="button"
			id="dropdownDisplayColumn"
			data-toggle="dropdown"
			aria-haspopup="true"
			aria-expanded="true"
			ref="dropdown"
		>
			<svg
				xmlns="http://www.w3.org/2000/svg"
				viewBox="0 0 20 20"
				fill="currentColor"
				:class="{
					'text-gray': !hasDisabledFilter,
					'text-green': hasDisabledFilter,
				}"
			>
				<path
					d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z"
				></path>
			</svg>
		</button>
		<div
			@click="$event.stopPropagation()"
			ref="dropdownMenu"
			class="dropdown-menu"
			aria-labelledby="dropdownDisplayColumn"
			x-placement="bottom-start"
		>
			<a
				v-for="(column, key) in columns"
				:key="key"
				class="dropdown-item"
				href="#"
			>
				<div class="custom-control custom-switch">
					<span>{{ column.label }}</span>
					<div>
						<input
							@change="toggle(key)"
							:disabled="isLastEnabledFilter(key)"
							:id="'column-switch' + key"
							:checked="column.enabled"
							type="checkbox"
							switch="success"
						/>
						<label :for="'column-switch' + key" class="m-0"></label>
					</div>
				</div>
			</a>
		</div>
	</div>
</template>

<script>
import filter from "lodash-es/filter";
import find from "lodash-es/find";

export default {
	props: {
		columns: {
			type: Object,
			required: true,
		},

		onChange: {
			type: Function,
			required: true,
		},
	},

	methods: {
		toggle(key) {
			this.onChange(key, !this.columns[key].enabled);
		},

		isLastEnabledFilter(key) {
			const enabledFilters = filter(
				this.columns,
				(filter, key) => filter.enabled
			);

			if (enabledFilters.length === 1) {
				return enabledFilters[0].key === key;
			}

			return false;
		},
	},

	computed: {
		hasDisabledFilter() {
			return find(this.columns, (filter, key) => !filter.enabled)
				? true
				: false;
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
svg.text-gray {
	color: rgba(156, 163, 175, 1);
}
svg.text-green {
	color: rgba(52, 211, 153, 1);
}
.btn-white {
	background-color: #fff;
}
.dropdown-item > .custom-control.custom-switch {
	display: flex;
	align-items: center;
	justify-content: space-between;
	padding: 0;
}
.dropdown-item {
	min-width: 200px;
	padding-top: 0.5rem;
	padding-bottom: 0.5rem;
}
.dropdown-item:not(:last-child) {
	border-bottom: 1px solid rgb(229, 231, 235);
}
.dropdown-item > .custom-control.custom-switch > div {
	display: flex;
}
input[switch]:disabled + label {
	cursor: not-allowed;
	opacity: 0.6;
}
</style>
