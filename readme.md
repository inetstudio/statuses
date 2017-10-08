# Elasticsearch

````
PUT app_index
PUT app_index/_mapping/statuses
{
  "properties": {
    "id": {
      "type": "integer"
  	},
    "name": {
  	  "type": "string"
    },
    "alias": {
  	  "type": "string"
    },    
	  "description": {
  	  "type": "text"
  	}
  }
}
````
