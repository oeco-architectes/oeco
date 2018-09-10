import { shallowMount } from '@vue/test-utils';
import ExampleComponent from './ExampleComponent.vue';

describe('ExampleComponent', () => {
    it('renders the header', () => {
        const wrapper = shallowMount(ExampleComponent);
        expect(wrapper.contains('.card-header')).toBe(true);
        expect(wrapper.find('.card-header').text()).toBe('Example Component');
    });

    it('renders the body', () => {
        const wrapper = shallowMount(ExampleComponent);
        expect(wrapper.contains('.card-body')).toBe(true);
        expect(wrapper.find('.card-body').text()).toBe("I'm an example component.");
    });
});
