import React from "react";
import { Row, Col, Card } from "react-bootstrap";
import { FaMapMarkerAlt } from "react-icons/fa";

const SingleNewsItem = () => {
  return (
    <Row className="py-1 px-1 mt-3">
      <Col md="5" className="mt-1 mb-1">
        <Card className="rounded-0">
          <Card.Body className="position-relative py-0 px-0">
            {/*eslint-disable-next-line @next/next/no-img-element*/}
            <img
              src={`https://www.nytimes.com/images/2024/06/08/multimedia/08nat-stanford-wzhb/08nat-stanford-wzhb-articleLarge.jpg`}
              alt={"news_name"}
              className={`w-100`}
              height={250}
            />
          </Card.Body>
        </Card>
      </Col>
      <Col md="7" className="border-bottom">
        <Card className="border-0">
          <Row className="py-2 px-1">
            <Col className="mt-2 mb-3">
              <div className="mt-2 mb-1 text-color-a3a fw-bold">
                <Row>
                  <Col lg="8" md="8" sm="8" xs="8" className="text-start ft-20">
                    news title
                  </Col>
                  <Col lg="4" md="4" sm="4" xs="4" className="text-end"></Col>
                </Row>
              </div>

              <div className="ft-14 mt-2 mb-1 text-color-b94">
                news descriptions .....
                <span>...</span>
              </div>
              <div className="mt-2"></div>
              <div className="mt-2">
                <Row className="">
                  <Col md="12" className="text-start fs-14 fw-bold text-dark">
                    <span className="mt-2">Sources</span>
                  </Col>
                </Row>
              </div>
            </Col>
          </Row>
        </Card>
      </Col>
    </Row>
  );
};

export default SingleNewsItem;
