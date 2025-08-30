const baseUrl = 'http://127.0.0.1:8000/api';

const createEmployee = async (employee) => {
  const response = await fetch(`${baseUrl}/employees`, {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'Accept': 'application/json',
      'Authorization': `Bearer ${localStorage.getItem('token')}`,
    },
    body: JSON.stringify(employee)
  })

  if (!response.ok) {
    const errors = await response.json();
    throw new Error(JSON.stringify(errors));
  }

  return 'Служителят е създаден успешно.';
};

export function employee() {
  return {
    createEmployee
  };
}