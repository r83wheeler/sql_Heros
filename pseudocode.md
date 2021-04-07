CRUD Operations for the Facebook for Heros

Create - hero, ability, arch nemesis, sidekick, rival

Read - all heros, heros that have the flying ability, relationship type

Update - hero's bio, new abilities, lose abilities, wins/losses (battles), sidekicks [modifies an existing record, where condition - id = immutable number] 

Delete - cascade and delete the base or do a soft delete [delete the record, where condition - id = immutable number] 

Actions: 

  Add a new hero
  
  Make a relaitionship between two heros
  
  Add a relationship type
  
  Add a new ability
  
  Assign or link an existing Ability to a Hero (ability id, hero id)
  
  Modify existing Relationship between Heros
  
Function: 

  getAllHeros - conn param, JSON formatted list of all heros
  
  getHeroById - conn, heroID, JSON formatted list of the specific hero
  
  createBattle - conn, hero 1's ID, hero 2's ID, winning hero ID