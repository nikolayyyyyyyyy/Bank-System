const baseUrl = 'http://127.0.0.1:8000/api';

const createClient = async (client) => {
  const response = await fetch(`${baseUrl}/clients`, {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'Accept': 'application/json',
      'Authorization': `Bearer ${localStorage.getItem('token')}`,
    },
    body: JSON.stringify(client)
  })

  if (!response.ok) {
    const errors = await response.json();
    throw new Error(JSON.stringify(errors));
  }

  return 'Клиентът е създаден успешно.';
};

export function client() {
  return {
    createClient
  };
}