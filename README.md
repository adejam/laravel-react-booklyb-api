# laravel-react-booklyb-api

> laravel-react-booklyb-api is a REST API written with Laravel framework to serve as backend for [react-booklyb](https://github.com/adejam/react-booklyb)

The project demonstrates the use of REST API in laravel that can be used across any frontend platform. [Laravel sanctum](https://laravel.com/docs/8.x/sanctum) is used for authentication which allows each user of the application to generate multiple API tokens for their account. These tokens are used to grant users access to features to the APIs.

## API Consumation

The base URL to consume the API is `https://peaceful-cove-38084.herokuapp.com/api/` which can be used with `axios`.
In addition, you should enable the `withCredentials` option on your global `axios` instance. like below:

```js
Axios.defaults.baseURL = "https://peaceful-cove-38084.herokuapp.com/api/";
Axios.defaults.withCredentials = true;
```

The user's authorization token is used in the configuration below with the fetch API like `Axios` to access features.

```js
const config = {
    headers: {
        Authorization: `Bearer ${$userToken}`
    }
};
```

### Authenticating Users

For Authenticating a user, the user table consists of three required colums which are `name`, `email`, and `password`.

#### Sign-up Feature
-   Signing up a user requires using the URL `https://peaceful-cove-38084.herokuapp.com/api/sign-up` with a `post` request.

```js
Axios.post(`sign-up`, values);
```

the `values` option is the values of the field the user submits i.e `name`, `email`, `password`.
This returns a json object with the following values.

```js
    "status": 200,
    "message": "Sign up Successful",
    "token": $userToken, // token generated after signing up a user or logging in
    "username": $username // user's name
```

#### Login Feature
-   Logging in a user uses the `https://peaceful-cove-38084.herokuapp.com/api/login` URL with a `post` request.

```js
Axios.post(`login`, values);
```

This returns a json object with the following values similar to the sign-up values.

```js
    "status": 200,
    "message": "Sign up Successful",
    "token": $userToken, // token generated after signing up a user or logging in
    "username": $username // user's name
```

#### Get user's name
-   To get a user's name we utilize the `https://peaceful-cove-38084.herokuapp.com/api/get-user` with a `get` request which returns a user's `name`.

```js
Axios.get(`get-user/`, config);
```

#### Log-out Feature
-   Logging out a user uses the `https://peaceful-cove-38084.herokuapp.com/api/logout` URL with a `get` request and `config`.

```js
Axios.get(`logout/`, config);
```


### Accessing Book Features

The following columns in the book table `bookTitle`, `bookAuthor`, `bookCategory`, `comment`, `numberOfPages`, `currentPageRead`, `currentChapterTitle`, and `currentChapterRead`  can be populated with the user's inputs.

The `bookTitle` and `bookCategory` field are **required** while the rest are **nullable**.

#### Add Book Feature
- Adding a book requires using the URL `https://peaceful-cove-38084.herokuapp.com/api/add-book` with a `post` request.

```js
Axios.post(`add-book`, values, config);
```

This returns a json object with the following values.

```js
   "status": 200,
   "message": "Book Added Successfully",
   "book": $book
```

The `$book` variable from above contains the following values: `bookId`, `bookTitle`, `bookAuthor`, `bookCategory`, `comment`, `numberOfPages`, `currentPageRead`, `currentChapterTitle`, and `currentChapterRead` where `bookId` is a unique string generated for each books.


#### Update Book Feature
- To Update a book we require using the URL `https://peaceful-cove-38084.herokuapp.com/api/update-book` with a `put` request.

```js
Axios.post(`update-book`, values, config);
```

This returns a json object with the following values.

```js
   "status": 200,
   "message": "Book Updated Successfully",
```


#### Get Books Feature
- To get all the books by a single user we use the `https://peaceful-cove-38084.herokuapp.com/api/books` with a `get` request.

```js
Axios.get(`books`, config);
```

This returns the variables `bookId`, `bookTitle`, `bookAuthor`, `bookCategory`, `comment`, `numberOfPages`, `currentPageRead`, `currentChapterTitle`, and `currentChapterRead` of each books by a single user.


#### Get single Book Feature

- To get a single book by a single user we use the `https://peaceful-cove-38084.herokuapp.com/api/books/${bookId}` with a `get` request.

```js
Axios.get(`books/${bookId}`, config);
```

This returns the variables `bookId`, `bookTitle`, `bookAuthor`, `bookCategory`, `comment`, `numberOfPages`, `currentPageRead`, `currentChapterTitle`, and `currentChapterRead` of a book with unique identity of `bookId`.

#### Delete single Book Feature

- To delete a single book by a user we use the `https://peaceful-cove-38084.herokuapp.com/api/delete-book/${bookId}` with a `delete` request using the unique identity `bookId`.

```js
Axios.delete(`delete-book/${bookId}`, config);
```



## Features

-   Sign in user
-   Authenticate user
-   Logging out user
-   Add Book feature
-   Get Books feature
-   Edit Book feature
-   Delete Book feature

## Technology Used

-   PHP

-   [laravel](https://laravel.com/)

-   PHP Code_Sniffer

-   PHP Code Beautifier

### Development (Running locally)

-   Clone the project

```bash
git clone https://github.com/adejam/laravel-react-booklyb-api.git

```

-   Install Dependencies

```bash
composer require
```

To check for errors on PHP

```bash
composer phpcs
```

Or to beautify PHP codes

```bash
composer phpcs
```

## Style Guides

-   [CSS Style Guide](http://udacity.github.io/frontend-nanodegree-styleguide/css.html)
-   [HTML Style Guide](http://udacity.github.io/frontend-nanodegree-styleguide/index.html)
-   [JavaScript Style Guide](http://udacity.github.io/frontend-nanodegree-styleguide/javascript.html)
-   [Git Style Guide](https://udacity.github.io/git-styleguide/)

## 👤 Author

### Adeleye Jamiu

-   Github: [@adejam](http://github.com/adejam)
-   Twitter: [@adeleye_oj](https://twitter.com/Adeleye_oj)
-   LinkedIn: [@adeleye-jamiu](https://linkedin.com/in/adeleye-jamiu)

## 🤝 Contributing

Contributions, issues and feature requests are welcome!

Feel free to check the [issues page](../../issues).

## Show your support

Give a ⭐️ if you like this project!

## Acknowledgments

-   [@bolah2009](http://github.com/bolah2009)

-   [laravel](https://laravel.com/)

-   [PHPUnit](https://phpunit.de/)

## 📝 License

[MIT licensed](./LICENSE).
