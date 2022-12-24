<%@ page session="true" contentType="text/html; charset=ISO-8859-1" %>
    <%@ taglib uri="http://www.tonbeller.com/jpivot" prefix="jp" %>
        <%@ taglib prefix="c" uri="http://java.sun.com/jstl/core" %>


            <jp:mondrianQuery id="query01" jdbcDriver="com.mysql.jdbc.Driver"
                jdbcUrl="jdbc:mysql://localhost/dwadv22?user=root&password="
                catalogUri="/WEB-INF/queries/PurchaseFact.xml">

                select {[Measures].[TotalOutcomes]} ON COLUMNS,
                {([Time].[All Times],[Employee].[All Employees],[Vendor].[All Vendors],[Product].[All Products])} ON ROWS
                from [Purchase]


            </jp:mondrianQuery>





            <c:set var="title01" scope="session">Query AdventureWorks Purchase using Mondrian OLAP</c:set>