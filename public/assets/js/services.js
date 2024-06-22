class services {
    constructor() {
        this.root_url = 'http://localhost:3000/'
    }
    register = async ({ ...data }) => {
        fetch(root_url + 'auth/register', {
            method: 'POST',
            headers: {'Content-Type': 'application/json'},
            body: JSON.stringify(data),
        })
            .then(response => response.json())
            .then(data => {
                console.log('Success:', data.error.details);
                return data.error.details
            })
        .catch(error => {
          console.error('Error:', error);
          // Handle errors here
        });
    }
}

// Export the class, so it can be imported in other files
export default services;