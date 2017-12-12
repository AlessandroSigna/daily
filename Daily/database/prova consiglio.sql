SELECT *
FROM prodotto P
WHERE LEFT(codice_prodotto,2) IN (
				SELECT LEFT (codice_prodotto,2)
				FROM storico_acquisti S2 JOIN prodotto P2 on S2.ref_oggetto_SA=P2.codice_prodotto
                WHERE S2.ref_cliente_SA='lollo883@yahoo.it'
				GROUP BY (LEFT(codice_prodotto,2))
				HAVING sum(qty_acquistati_SA)>= 
								ALL(SELECT SUM(qty_acquistati_SA) AS TotaleAcquisti
								FROM storico_acquisti S3 JOIN prodotto P3 on S3.ref_oggetto_SA=P3.codice_prodotto
                                WHERE S3.ref_cliente_SA='lollo883@yahoo.it'
                                GROUP BY LEFT (P3.codice_prodotto,2)))
AND RIGHT (codice_prodotto,2) NOT IN (
				SELECT RIGHT (P2.codice_prodotto,2)
                FROM prodotto AS P2 JOIN  storico_acquisti S2 ON P2.codice_prodotto=S2.ref_oggetto_SA
                WHERE S2.ref_cliente_SA = 'lollo883@yahoo.it' AND LEFT(P.codice_prodotto,2)=LEFT(P2.codice_prodotto,2)  )
ORDER BY rand()
LIMIT 4;