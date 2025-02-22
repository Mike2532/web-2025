PROGRAM SarahRever(INPUT, OUTPUT);
USES
  DOS;
BEGIN
  WRITELN('Content-Type: text/plain');
  WRITELN;
  IF GetEnv('QUERY_STRING') = 'lanters=1'
  THEN
    WRITELN('The British are camming by land')
  ELSE
    IF GetEnv('QUERY_STRING') = 'lanters=2'
    THEN
      WRITELN('The British are camming by sea')
    ELSE
      WRITELN('Sarah didnt say')
END.
