# php_deploy_from_github
Simple PHP Git deploy script without installing Git on hosting  - Only php functions

Automatically deploy the code using PHP and GitHub WebHooks. 
Tested only with data format from github. bitbucket has a different payload format =(

# usage
1. register the required variables inside the script. Come up with your secret word.
2.upload the script to the server
3.create a webhook on github with the correct script address and secret word
example:
https://mysite.org/deploy_from_git.php?secret=supersecret

# correct payload example (json)
```json

{
  "action": "edited",
  "rule": {
    "id": 21796960,
    "repository_id": 259377789,
    "name": "production",
    "created_at": "2021-08-19T12:16:32.000-04:00",
    "updated_at": "2021-08-19T12:16:32.000-04:00",
    "pull_request_reviews_enforcement_level": "off",
    "required_approving_review_count": 1,
    "dismiss_stale_reviews_on_push": false,
    "require_code_owner_review": false,
    "authorized_dismissal_actors_only": false,
    "ignore_approvals_from_contributors": false,
    "required_status_checks": [
      "basic-CI"
    ],
    "required_status_checks_enforcement_level": "non_admins",
    "strict_required_status_checks_policy": false,
    "signature_requirement_enforcement_level": "off",
    "linear_history_requirement_enforcement_level": "off",
    "admin_enforced": false,
    "allow_force_pushes_enforcement_level": "off",
    "allow_deletions_enforcement_level": "off",
    "merge_queue_enforcement_level": "off",
    "required_deployments_enforcement_level": "off",
    "required_conversation_resolution_level": "off",
    "authorized_actors_only": true,
    "authorized_actor_names": [
      "Codertocat"
    ]
  },
  "changes": {
    "authorized_actors_only": {
      "from": false
    },
    "authorized_actor_names": {
      "from": []
    }
  },
  "repository": {
    "id": 17273051,
    "node_id": "MDEwOlJlcG9zaXRvcnkxNzI3MzA1MQ==",
    "name": "octo-repo",
    "full_name": "octo-org/octo-repo",
    "private": true,
    "owner": {
      "login": "octo-org",
      "id": 6811672,
      "node_id": "MDEyOk9yZ2FuaXphdGlvbjY4MTE2NzI=",
      "avatar_url": "https://avatars.githubusercontent.com/u/6811672?v=4",
      "gravatar_id": "",
      "url": "https://api.github.com/users/octo-org",
      "html_url": "https://github.com/octo-org",
      "followers_url": "https://api.github.com/users/octo-org/followers",
      "following_url": "https://api.github.com/users/octo-org/following{/other_user}",
      "gists_url": "https://api.github.com/users/octo-org/gists{/gist_id}",
      "starred_url": "https://api.github.com/users/octo-org/starred{/owner}{/repo}",
      "subscriptions_url": "https://api.github.com/users/octo-org/subscriptions",
      "organizations_url": "https://api.github.com/users/octo-org/orgs",
      "repos_url": "https://api.github.com/users/octo-org/repos",
      "events_url": "https://api.github.com/users/octo-org/events{/privacy}",
      "received_events_url": "https://api.github.com/users/octo-org/received_events",
      "type": "Organization",
      "site_admin": false
    },
    "html_url": "https://github.com/octo-org/octo-repo",
    "description": "My first repo on GitHub!",
    "fork": false,
    "url": "https://api.github.com/repos/octo-org/octo-repo",
    "forks_url": "https://api.github.com/repos/octo-org/octo-repo/forks",
    "keys_url": "https://api.github.com/repos/octo-org/octo-repo/keys{/key_id}",
    "collaborators_url": "https://api.github.com/repos/octo-org/octo-repo/collaborators{/collaborator}",
    "teams_url": "https://api.github.com/repos/octo-org/octo-repo/teams",
    "hooks_url": "https://api.github.com/repos/octo-org/octo-repo/hooks",
    "issue_events_url": "https://api.github.com/repos/octo-org/octo-repo/issues/events{/number}",
    "events_url": "https://api.github.com/repos/octo-org/octo-repo/events",
    "assignees_url": "https://api.github.com/repos/octo-org/octo-repo/assignees{/user}",
    "branches_url": "https://api.github.com/repos/octo-org/octo-repo/branches{/branch}",
    "tags_url": "https://api.github.com/repos/octo-org/octo-repo/tags",
    "blobs_url": "https://api.github.com/repos/octo-org/octo-repo/git/blobs{/sha}",
    "git_tags_url": "https://api.github.com/repos/octo-org/octo-repo/git/tags{/sha}",
    "git_refs_url": "https://api.github.com/repos/octo-org/octo-repo/git/refs{/sha}",
    "trees_url": "https://api.github.com/repos/octo-org/octo-repo/git/trees{/sha}",
    "statuses_url": "https://api.github.com/repos/octo-org/octo-repo/statuses/{sha}",
    "languages_url": "https://api.github.com/repos/octo-org/octo-repo/languages",
    "stargazers_url": "https://api.github.com/repos/octo-org/octo-repo/stargazers",
    "contributors_url": "https://api.github.com/repos/octo-org/octo-repo/contributors",
    "subscribers_url": "https://api.github.com/repos/octo-org/octo-repo/subscribers",
    "subscription_url": "https://api.github.com/repos/octo-org/octo-repo/subscription",
    "commits_url": "https://api.github.com/repos/octo-org/octo-repo/commits{/sha}",
    "git_commits_url": "https://api.github.com/repos/octo-org/octo-repo/git/commits{/sha}",
    "comments_url": "https://api.github.com/repos/octo-org/octo-repo/comments{/number}",
    "issue_comment_url": "https://api.github.com/repos/octo-org/octo-repo/issues/comments{/number}",
    "contents_url": "https://api.github.com/repos/octo-org/octo-repo/contents/{+path}",
    "compare_url": "https://api.github.com/repos/octo-org/octo-repo/compare/{base}...{head}",
    "merges_url": "https://api.github.com/repos/octo-org/octo-repo/merges",
    "archive_url": "https://api.github.com/repos/octo-org/octo-repo/{archive_format}{/ref}",
    "downloads_url": "https://api.github.com/repos/octo-org/octo-repo/downloads",
    "issues_url": "https://api.github.com/repos/octo-org/octo-repo/issues{/number}",
    "pulls_url": "https://api.github.com/repos/octo-org/octo-repo/pulls{/number}",
    "milestones_url": "https://api.github.com/repos/octo-org/octo-repo/milestones{/number}",
    "notifications_url": "https://api.github.com/repos/octo-org/octo-repo/notifications{?since,all,participating}",
    "labels_url": "https://api.github.com/repos/octo-org/octo-repo/labels{/name}",
    "releases_url": "https://api.github.com/repos/octo-org/octo-repo/releases{/id}",
    "deployments_url": "https://api.github.com/repos/octo-org/octo-repo/deployments",
    "created_at": "2014-02-28T02:42:51Z",
    "updated_at": "2021-03-11T14:54:13Z",
    "pushed_at": "2021-03-11T14:54:10Z",
    "git_url": "git://github.com/octo-org/octo-repo.git",
    "ssh_url": "org-6811672@github.com:octo-org/octo-repo.git",
    "clone_url": "https://github.com/octo-org/octo-repo.git",
    "svn_url": "https://github.com/octo-org/octo-repo",
    "homepage": "",
    "size": 300,
    "stargazers_count": 0,
    "watchers_count": 0,
    "language": "JavaScript",
    "has_issues": true,
    "has_projects": false,
    "has_downloads": true,
    "has_wiki": false,
    "has_pages": true,
    "forks_count": 0,
    "mirror_url": null,
    "archived": false,
    "disabled": false,
    "open_issues_count": 39,
    "license": null,
    "forks": 0,
    "open_issues": 39,
    "watchers": 0,
    "default_branch": "main"
  },
  "organization": {
    "login": "octo-org",
    "id": 6811672,
    "node_id": "MDEyOk9yZ2FuaXphdGlvbjY4MTE2NzI=",
    "url": "https://api.github.com/orgs/octo-org",
    "repos_url": "https://api.github.com/orgs/octo-org/repos",
    "events_url": "https://api.github.com/orgs/octo-org/events",
    "hooks_url": "https://api.github.com/orgs/octo-org/hooks",
    "issues_url": "https://api.github.com/orgs/octo-org/issues",
    "members_url": "https://api.github.com/orgs/octo-org/members{/member}",
    "public_members_url": "https://api.github.com/orgs/octo-org/public_members{/member}",
    "avatar_url": "https://avatars.githubusercontent.com/u/6811672?v=4",
    "description": "Working better together!"
  },
  "sender": {
    "login": "Codertocat",
    "id": 21031067,
    "node_id": "MDQ6VXNlcjIxMDMxMDY3",
    "avatar_url": "https://avatars1.githubusercontent.com/u/21031067?v=4",
    "gravatar_id": "",
    "url": "https://api.github.com/users/Codertocat",
    "html_url": "https://github.com/Codertocat",
    "followers_url": "https://api.github.com/users/Codertocat/followers",
    "following_url": "https://api.github.com/users/Codertocat/following{/other_user}",
    "gists_url": "https://api.github.com/users/Codertocat/gists{/gist_id}",
    "starred_url": "https://api.github.com/users/Codertocat/starred{/owner}{/repo}",
    "subscriptions_url": "https://api.github.com/users/Codertocat/subscriptions",
    "organizations_url": "https://api.github.com/users/Codertocat/orgs",
    "repos_url": "https://api.github.com/users/Codertocat/repos",
    "events_url": "https://api.github.com/users/Codertocat/events{/privacy}",
    "received_events_url": "https://api.github.com/users/Codertocat/received_events",
    "type": "User",
    "site_admin": false
  }
}

```
