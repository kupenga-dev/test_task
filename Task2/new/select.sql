SELECT *
FROM data
JOIN link ON link.data_id = data.id
JOIN info ON link.info_id = info.id;