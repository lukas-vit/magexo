import { mount } from '@vue/test-utils';
import EmployeeList from '@/components/EmployeeList.vue';
import axios from 'axios';

jest.mock('axios');

describe('EmployeeList', () => {
  it('renders employee list correctly', async () => {
    const employees = [
      { id: 1, name: 'John Doe', designation: 'Software Engineer', email: 'john@example.com', department: 'IT' },
      { id: 2, name: 'Jane Smith', designation: 'Web Developer', email: 'jane@example.com', department: 'Marketing' },
    ];

    axios.get.mockResolvedValueOnce({ data: employees });

    const wrapper = mount(EmployeeList);

    await wrapper.vm.$nextTick();

    expect(wrapper.findAll('.employee-item')).toHaveLength(2);
  });

  it('deletes an employee', async () => {
    const employee = { id: 1, name: 'John Doe', designation: 'Software Engineer', email: 'john@example.com', department: 'IT' };

    axios.delete.mockResolvedValueOnce({ status: 204 });

    const wrapper = mount(EmployeeList);

    await wrapper.vm.$nextTick();

    wrapper.find('.delete-button').trigger('click');

    await wrapper.vm.$nextTick();

    expect(axios.delete).toHaveBeenCalledWith('/api/employees/1');
    expect(wrapper.findAll('.employee-item')).toHaveLength(0);
  });
});
