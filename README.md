Needs the [serverless framework](https://serverless.com/)

* don't forget to [set up your credentiasl](https://serverless.com/framework/docs/providers/aws/guide/credentials/)
* don't forget to run `npm install`
* create `.env` file, take `.env.example` as boilerplate

create the domains from the serverless.yml file:

```
sls create_domain --stage dev
sls create_domain --stage prod
...
```

deploy with

```
sls deploy --stage dev
```

default environment is **dev**

see if your api works:

```
curl -X GET https://dev-api.YOURDOMAIN.com 
```

## TODO
* do not hardcode domain name in serverless.yml
* integrate **travisci** 
* handle form fields and google recaptcha
* make `modules/form.js` agnostic of SES
* remove AWS credentials from `.env` file, and use AWS IAM or other mechanism