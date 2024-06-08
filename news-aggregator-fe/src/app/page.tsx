import Image from "next/image";
import styles from "./page.module.css";
import { Col, Container, Row } from "react-bootstrap";
import HomeComponent from "./components/home/HomeComponent";

export default function Home() {
  return (
    <>
      <Container>
        <Row>
          <Col>
            <HomeComponent />
          </Col>
        </Row>
      </Container>
    </>
  );
}
