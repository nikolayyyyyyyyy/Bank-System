const baseUrl = 'http://127.0.0.1:8000/api';

const createAccount = async (account) => {
  const response = await fetch(`${baseUrl}/accounts`, {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'Accept': 'application/json',
      'Authorization': `Bearer ${localStorage.getItem('token')}`,
    },
    body: JSON.stringify(account)
  })

  if (!response.ok) {
    const errors = await response.json();
    throw new Error(JSON.stringify(errors));
  }

  return 'Акаунтът е създаден успешно.'
};

const getAccounts = async () => {
  const response = await fetch(`${baseUrl}/accounts`, {
    method: 'GET',
    headers: {
      'Accept': 'application/json',
      'Content-Type': 'application/json',
      'Authorization': `Bearer ${localStorage.getItem('token')}`
    }
  });

  if (response.ok) {
    return await response.json();
  }
};

export function account() {
  return {
    createAccount,
    getAccounts
  };
}