Needs the [serverless framework](https://serverless.com/) and an AWS account

* don't forget to [set up your aws credentiasl](https://serverless.com/framework/docs/providers/aws/guide/credentials/)
* don't forget to run `npm install`

create the domains from the serverless.yml file:

```
sls create_domain --stage dev
sls create_domain --stage prod
...
```

create the environmental variables in AWS SSM

```
aws ssm put-parameter --name "/api.YOURDOMAIN.com/environment/{ENVIRONMENT_NAME_FROM_ABOVE}/fromAddress" --value "YOUR_VALUE" --type String
aws ssm put-parameter --name "/api.YOURDOMAIN.com/environment/{ENVIRONMENT_NAME_FROM_ABOVE}/toAddress" --value "YOUR_VALUE" --type String
aws ssm put-parameter --name "/api.YOURDOMAIN.com/environment/{ENVIRONMENT_NAME_FROM_ABOVE}/mailSubject" --value "YOUR_VALUE" --type String
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
* use view for email body (plain text and html)
* handle form fields **and** google recaptcha
* error handling