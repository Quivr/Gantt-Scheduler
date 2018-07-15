@extends('layouts.app')

@section('content')
<div class="container">
  <h3>Departement</h3>
  Je kan via <a href={{route('resources.index')}}>deze link</a> alle departementen bekijken en aanduiden tot welk departement je behoort.</br>
  Je zal dan standaard enkel de planning zien van je eigen departement.

  <h3>Taak</h3>
  Een taak is het kleinste stuk in de planner. Elke taak wordt weergegeven als een blokje.</br>
  Je kan een nieuwe taak aanmaken via <a href={{route('tasks.create')}}>deze link</a>.</br>
  Geen nood, je kan ze later nog aanpassen en niet alle velden zijn verplicht.</br>
  </br>
  Na het aanmaken van een taak kan je ook aanduiden hoever je al zit met de taak. Zo kan de rest van het team makkelijk volgen hoe ver je al zit.

  <div class="alert alert-warning">
    Pas op, als je een taak aanmaakt met hetzelfde start en begin moment kan de styling serieus verpest worden.</br>
    Gelieve dat te vermijden ;)
  </div>

  <h3>Dependency</h3>
  Soms kan je niet aan een taak beginnen voor een andere taak voltooid is.</br>
  Dat kan je aanduiden met een dependency. In het rooster wordt dit dan met een pijl weergegeven.

  <h3>Resource</h3>
  Een resource is een grote overkoepelende taak, dit zou grote nieuwe feature kunnen zijn. Een taak hoort maar bij 1 resource.</br>
  Elke taak moet een resource hebben

  <h3>Tag</h3>
  Een tag kan iets zijn zoals "bug fix", kan handig zijn om dan alle bug fixes te groeperen

  <h3>Vragen</h3>
  Nog een vraag? Of een bug gevonden? -> Thijs

</div>
@endsection
